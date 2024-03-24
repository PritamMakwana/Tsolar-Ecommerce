<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReturnProduct;
use Illuminate\Http\Request;

class ReturnProductControllers extends Controller
{
    public function showReturnProduct(Request $request)
    {
        $pagi = true;
        $data = ReturnProduct::with('order.cart.products')->paginate(10);

        // dd($data);


        if ($request->has('view_deleted')) {
            $data = ReturnProduct::with('order.cart.products')->onlyTrashed()->get();
            $pagi = false;
        }

        return view('backend.returnProduct.return-product', compact('data', 'pagi'));
    }



    public function deleteReturnProduct($id)
    {
        $delete = ReturnProduct::find($id)->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Product Return Deleted Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function forceDeleteReturnProduct($id)
    {
        $delete = ReturnProduct::onlyTrashed()->find($id)->forceDelete();

        if ($delete) {
            $notification = array(
                'message' => 'Product Return Deleted Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function deleteAllReturnProduct()
    {
        $delete = ReturnProduct::onlyTrashed()->forceDelete();

        if ($delete) {
            $notification = array(
                'message' => 'All Trashed Cleared Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    public function restoreReturnProduct($id)
    {
        $restore = ReturnProduct::withTrashed()->find($id)->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Product Return restored Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('return-product.show', ['view_deleted' => 'DeletedReturnProduct'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('return-product.show', ['view_deleted' => 'DeletedReturnProduct'])->with($notification);
        }
    }

    public function restoreAllReturnProduct()
    {
        $restore = ReturnProduct::onlyTrashed()->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Restored All Trashed Brands',
                'alert-type' => 'success'
            );
            return redirect()->route('return-product.show', ['view_deleted' => 'DeletedReturnProduct'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('return-product.show', ['view_deleted' => 'DeletedReturnProduct'])->with($notification);
        }
    }

}
