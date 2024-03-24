<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use App\Models\SizeQuantity;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->where('payment_status', false)->get();
        return view('frontend.cart', compact('cart'));
    }

    public function add_product(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|exists:size_quantities,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Cart::where('customer_id', Auth::guard('customer')->user()->id)->where('products_id', $request->product_id)->where('size_id', $request->size)->where('payment_status', false)->first();

        if ($product) {
            // check quantity availablity for the selected size
            $size = SizeQuantity::where('products_id', $request->product_id)->where('id', $request->size)->first();
            if ($size && $size->quantity < $request->quantity + $product->quantity) {
                return redirect()->back()->with('error', 'Please select a valid quantity');
            }
            $product->quantity = $product->quantity + $request->quantity;
            $product->save();
            return redirect()->route('cart.index');
        }

        // check quantity availablity for the selected size
        $size = SizeQuantity::where('products_id', $request->product_id)->where('id', $request->size)->first();
        if ($size && $size->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Please select a valid quantity');
        }

        $cart = Cart::create([
            'customer_id' => Auth::guard('customer')->user()->id,
            'products_id' => $request->product_id,
            'size_id' => $request->size,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index');
    }

    public function remove_product($id)
    {
        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->where('id', $id)->first();
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }

    public function update_quantity()
    {

        $quantity = request()->quantity;
        $id = request()->id;

        $cart = Cart::where('customer_id', Auth::guard('customer')->user()->id)->where('id', $id)->first();

        // check quantity availablity for the selected size
        $size = SizeQuantity::where('products_id', $cart->products_id)->where('id', $cart->size_id)->first();
        if ($size && $size->quantity < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Please select a valid quantity'
            ], 500);
        }
        $cart->quantity = $quantity;
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully'
        ], 200);
    }

}