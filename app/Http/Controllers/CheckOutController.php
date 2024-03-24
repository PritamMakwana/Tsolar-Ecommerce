<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Countries;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Srmklive\PayPal\Services\PayPal;

class CheckOutController extends Controller
{

    public function checkout()
    {
        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->where('payment_status', false)->latest()->get();
        $countries = Countries::all();
        $address = Addresses::where('customer_id', Auth::guard('customer')->user()->id)->latest()->first();
        // Api

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://www.universal-tutorial.com/api/getaccesstoken');
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'api-token: srvyVOo-ysBszMBH4eLPZiICvvNn1vsy1njtFZLaK6VP9f8ykWlH4tt50lmImoREkHM', // do not change
            'user-email: het.parekh.quantumitinnovation@gmail.com', // do not change
        ]
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        $auth = json_decode($result)->auth_token;

        // Api End

        if ($cart->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Please add some products to cart');
        }
        return view('frontend.checkout', compact('cart', 'countries', 'auth', 'address'));
    }

    public function payment(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'cart' => 'required|array|min:1',
            'address' => 'required|string',
            'address2' => 'nullable|string',
            'state' => 'required|string',
            'country' => 'required|exists:countries,name',
            'zipcode' => 'required|string',
        ]);

        $address = Addresses::create([
            'customer_id' => Auth::guard('customer')->user()->id,
            'line1' => $request->address,
            'line2' => $request->address2,
            'state' => $request->state,
            'country' => $request->country,
            'zip' => $request->zipcode,
        ]);

        $carts = $request->cart;

        // store the cart id in session
        FacadesSession::put('carts', $carts);
        FacadesSession::put('address', $address->id);

        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->wherein('id', $carts)->where('payment_status', false)->get();

        $total = 0;
        foreach ($cart as $item) {
            $total += $item->total;
        }

        // dd($total);

        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ]
                ],
            ],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cart.checkout')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('cart.checkout')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

    }

    public function paypal_return(Request $request)
    {
        // dd($request->all());
        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['id']) && $response['id'] != null) {
            $link = $this->order_success(FacadesSession::get('carts'), $request->token, $request->PayerID, FacadesSession::get('address'));
            FacadesSession::flash('successPayment', 'Order placed successfully');
            return redirect()->route('order.index')->with('link', $link);
            // redirect with order id
            // return redirect()->route('order.show',$link);
        } else {
            return redirect()
                ->route('cart.checkout')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paypal_cancel(Request $request)
    {
        return redirect()
            ->route('cart.checkout')
            ->with('error', 'You have cancelled your recent PayPal payment!');
    }


    private function order_success($carts, $token, $payerId, $address)
    {

        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->wherein('id', $carts)->where('payment_status', false)->get();
        // update the order table
        $order = Order::create([
            'order_id' => 'ORD-' . rand(100000, 999999),
            'customer_id' => Auth::guard('customer')->user()->id,
            'address_id' => $address,
            'token' => $token,
            'PayerID' => $payerId,
        ]);

        // update the size_quantity table
        foreach ($cart as $item) {
            $size = $item->size;
            $size->quantity = $size->quantity - $item->quantity;
            $item->order_id = $order->id;
            $item->payment_status = true;
            $item->save();
            $size->save();
        }

        return $order->id;
    }

}
