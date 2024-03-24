<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        // get all orders of the logged in customer with the cart details
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->with('cart')->get();
        return view('frontend.order.index', compact('orders'));
    }


    public function returnOrderPage($id)
    {
        $cart = Cart::find($id);
        $order = Order::with('cart.products')->find($cart->order_id);
        // dd($order);
        return view('frontend.order.return-products', compact('order', 'cart'));
    }


    public function returnProductData(Request $request)
    {
        $data = $request->all();
        // dd($data);

        // Define validation rules
        $rules = [
            'confrimreturn' => 'required|accepted',
            // Must be checked
            'qtytoreturn' => 'required|numeric|not_in:0',
            // Must be a number
            'reasontoreturn' => 'required|in:Defective Product,Wrong Item,Not Satisfied',
            // Must be one of these values
            'comments' => 'nullable|string',
            // Optional, but if provided, it should be a string
        ];

        // Define custom error messages
        $messages = [
            'confrimreturn.required' => 'Please confirm the return.',
            'confrimreturn.accepted' => 'You must confirm the return.',
            'qtytoreturn.required' => 'Please select the quantity to return.',
            'qtytoreturn.numeric' => 'The quantity to return must be a number.',
            'reasontoreturn.required' => 'Please select a reason to return.',
            'reasontoreturn.in' => 'Invalid reason selected.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $returnOrder = ReturnProduct::where('cart_id', $request->cart_id)->first();

        if ($returnOrder) {
            return redirect()->route('order.index')->with('error', 'You have already requested to return this product.');
        }

        ReturnProduct::create([
            'order_id' => $request->return_id,
            'cart_id' => $request->cart_id,
            'quantity' => $request->qtytoreturn,
            'reason' => $request->reasontoreturn,
            'comments' => $request->comments,
        ]);

        return redirect()->route('homepage')->with('successReturnProduct', 'Your response was recorded successfully.');

    }

    public function trackOrder($order_id, $cart_id = null)
    {
        $order = Order::find($order_id);

        if ($cart_id != null) {
            $cart = Cart::find($cart_id);
            $order_status = $cart->orderstatus;
            return view('frontend.order.track-single', compact('order', 'cart', 'order_status'));
        }

        $cart = Cart::where('order_id', $order_id)->get();
        $order_status = OrderStatus::where('cart_id', $cart[0]->id)->where('bulk', 1)->first();

        return view('frontend.order.track-bulk', compact('order', 'cart', 'order_status'));

    }

}
