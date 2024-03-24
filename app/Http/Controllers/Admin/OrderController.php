<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Products;
use App\Models\Status;

class OrderController extends Controller
{
    public function showOrders()
    {

        $orders = Order::paginate(10);
        return view('backend.order.index', compact('orders'));

    }


    public function OrderDetails($id)
    {

        $order = Order::find($id);
        $status = Status::all();
        $cart = Cart::where('order_id', $id)->get();

        $order_status = null ;

        if($order->bunch){
            $order_status = OrderStatus::where('cart_id', $cart[0]->id)->where('bulk', 1)->first();
        }

        return view('backend.order.details', compact('order', 'cart', 'status', 'order_status'));

    }

    public function order_status_single($cart_id)
    {
        $cart = Cart::find($cart_id);
        $order_status = OrderStatus::where('cart_id', $cart_id)->first();
        $status = Status::all();
        // dd($order_status->status);
        return view('backend.order.status', compact('cart', 'order_status', 'status'));

    }

    public function order_status_update(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'cart_id' => 'required',
            'update' => 'required',
        ]);

        $cart = Cart::find($request->cart_id);

        $update = array();

        // dd($cart->orderstatus);

        if (count($request->update) % 3 == 0) {
            for ($i = 0; $i < count($request->update); $i += 3) {
                array_push($update, [
                    'status' => $request->update[$i],
                    'date' => $request->update[$i + 1],
                    'update' => $request->update[$i + 2],
                ]);
            }
        }

        if ($cart->order->bunch) {
            $order = OrderStatus::where('cart_id', $cart->id)->where('bulk', 1)->first();

            if ($order) {
                $order->status = $update;
                $order->save();
            } else {
                OrderStatus::create([
                    'cart_id' => $cart->id,
                    'status' => $update,
                    'bulk' => 1,
                ]);
            }

        } else {
            if ($cart) {

                if ($cart->orderstatus) {
                    $cart->orderstatus->status = $update;
                    $cart->orderstatus->save();
                } else {
                    $cart->orderstatus()->create([
                        'cart_id' => $cart->id,
                        'status' => $update,
                    ]);
                }

            } else {
                return redirect()->back()->with([
                    'message' => 'Something went wrong',
                    'alert-type' => 'error',
                ]);
            }
        }

        return redirect()->back()->with([
            'message' => 'Order status updated successfully',
            'alert-type' => 'success',
        ]);

    }

    public function order_bunch_status()
    {

        $id = request()->order_id;
        $status = request()->status;

        $order = Order::find($id);

        if ($order) {

            $order->bunch = $status;
            $order->save();

            return response()->json(['success' => 'Status updated successfully'], 200);

        } else {

            return response()->json(['error' => 'Something went wrong'], 500);

        }

        // $status == true ? $order->bunch == 1 : $order->bunch == 0;

        // $order->save();

        // return response()->json(['success' => 'Status updated successfully']);

    }

}