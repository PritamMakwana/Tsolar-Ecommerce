<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function showBrands(Request $request)
    {

        $data = Brand::paginate(10);

        if ($request->has('view_deleted')) {
            $data = Brand::onlyTrashed()->paginate(10);
        }

        return view('backend.brand.list-brand', compact('data'));

    }

    public function addBrand(Request $request)
    {

        $request->validate([
            'brand_name' => 'required',
        ], [
            'brand_name.required' => 'Brand Name field is required.',
        ]);

        $brand_name = $request->brand_name;

        $brand = new Brand();
        $brand->brand_name = $brand_name;
        $insert = $brand->save();

        if ($insert) {
            $notification = array(
                'message' => 'Brand Added Successfully',
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

    public function editBrand(Request $request)
    {

        $request->validate([
            'id' => 'required',
        ], [
            'id.required' => 'Brand id is required.',
        ]);

        $id = $request->id;

        $data = Brand::find($id);
        return response()->json($data);
    }

    public function updateBrand(Request $request)
    {

        $request->validate([
            'brand_name' => 'required',
            'id' => 'required',
        ], [
            'brand_name.required' => 'Brand Name field is required.',
            'id.required' => 'Brand id is required.',
        ]);

        $id = $request->id;

        $brand_name = $request->brand_name;

        $brand = Brand::find($id);
        $brand->brand_name = $brand_name;
        $update = $brand->save();

        if ($update) {
            $notification = array(
                'message' => 'Brand Updated Successfully',
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

    public function deleteBrand($id)
    {
        $delete = Brand::find($id)->delete();

        if ($delete) {
            $notification = array(
                'message' => 'Brand Deleted Successfully',
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

    public function forceDeleteBrand($id)
    {
        $delete = Brand::onlyTrashed()->find($id)->forceDelete();

        if ($delete) {
            $notification = array(
                'message' => 'Brand Deleted Successfully',
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

    public function deleteAllBrand()
    {
        $delete = Brand::onlyTrashed()->forceDelete();

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

    public function restoreBrand($id)
    {
        $restore = Brand::withTrashed()->find($id)->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Brand restored Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('brand.show', ['view_deleted' => 'DeletedBrands'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('brand.show', ['view_deleted' => 'DeletedBrands'])->with($notification);
        }
    }

    public function restoreAllBrand()
    {
        $restore = Brand::onlyTrashed()->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Restored All Trashed Brands',
                'alert-type' => 'success'
            );
            return redirect()->route('brand.show', ['view_deleted' => 'DeletedBrands'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('brand.show', ['view_deleted' => 'DeletedBrands'])->with($notification);
        }
    }

}