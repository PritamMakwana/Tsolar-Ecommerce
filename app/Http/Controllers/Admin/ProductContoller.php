<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SizeQuantity;
use App\Models\Brand;
use App\Models\Tags;
use Intervention\Image\Facades\Image;

class ProductContoller extends Controller
{
    public function showProducts(Request $request)
    {
        $pagi = true;
        $data = Products::paginate(10);

        if ($request->has('view_deleted')) {
            $data = Products::onlyTrashed()->get();
            $pagi = false;
        }

        return view('backend.product.list-products', compact('data', 'pagi'));

    }

    public function addPageProducts()
    {
        $category_data = Category::get();
        $brands = Brand::get();
        $tags = Tags::get();
        return view('backend.product.add-product', compact('category_data', 'brands', 'tags'));
    }

    public function addProducts(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'specification' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            // 'quantity' => 'required|numeric',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
            'product_images.*' => 'mimes:jpeg,jpg,png|max:10000',
            'size_quantity.*' => 'required',
            'brand' => 'required',
            'material' => 'required|string',
            'shipping' => 'required|numeric|min:0',
            'tags' => 'nullable|array',
        ], [
            'category.required' => 'The category field is required.',
            'name.required' => 'The product name field is required.',
            'specification.required' => 'The specification field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a numeric value.',
            'discount.numeric' => 'The discount must be a numeric value.',
            // 'quantity.required' => 'The quantity field is required.',
            // 'quantity.numeric' => 'The quantity must be a numeric value.',
            'image.required' => 'Image field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
            'product_images.*.mimes' => 'The product images must have a valid JPEG, JPG, or PNG file.',
            'product_images.*.max' => 'The product images must not exceed 10MB in size.',
            'size_quantity.*.required' => 'The size and quantity field is required.',
            'brand.required' => 'The brand field is required.',
            'material.required' => 'The material field is required.',
            'shipping.required' => 'The shipping field is required.',
            'shipping.numeric' => 'The shipping must be a numeric value.',
            'shipping.min' => 'The shipping must be a positive value.',
        ]);

        // Upload Image to folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('Product_images'), $imageName);
        Image::make(public_path('Product_images/' . $imageName))->fit(300, 300)->save(public_path('Product_thumbnails/' . $imageName));

        $productImages = [];
        // Upload Product Images to folder
        if ($request->has('product_images') && $request->product_images != null) {
            foreach ($request->product_images as $product_image) {
                // get a unique name for the image with extension , without using time() function and original name
                $productImageName = time() . rand(100, 999) . '.' . $product_image->extension();
                $product_image->move(public_path('Product_images'), $productImageName);
                array_push($productImages, $productImageName);
            }
        }


        // dd($productImages);

        // Get the last Product ID from the database
        $lastProduct = Products::orderBy('id', 'desc')->first();

        // Calculate the next Product ID
        $nextID = $lastProduct ? $lastProduct->id + 1 : 1;
        $ProductID = 'PD-' . str_pad($nextID, 3, '0', STR_PAD_LEFT);

        $product = Products::create([
            'category_id' => $request->input('category'),
            'product_id' => $ProductID,
            'product_name' => $request->input('name'),
            'specification' => $request->input('specification'),
            'price' => $request->input('price'),
            'shipping' => $request->input('shipping'),
            'discount' => $request->input('discount'),
            'image' => $imageName,
            'product_images' => $productImages,
            'material' => $request->input('material'),
            'brand_id' => $request->input('brand'),
            'tags' => $request->input('tags'),
        ]);

        if ($product) {
            $notification = array(
                'message' => 'Product Added Successfully',
                'alert-type' => 'success'
            );

            $size_quantity = $request->size_quantity;

            if (count($size_quantity) % 2 == 0) {
                for ($i = 0; $i < count($size_quantity); $i += 2) {
                    SizeQuantity::create([
                        'size' => $size_quantity[$i],
                        'quantity' => $size_quantity[$i + 1],
                        'products_id' => $product->id,
                    ]);
                }
            }


            return redirect()->route('show-products')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-products')->with($notification);
        }
    }


    public function editPageProducts($id)
    {
        $data = Products::where('id', '=', $id)->first();
        $category_data = Category::get();
        $size_quantity = SizeQuantity::where('products_id', '=', $id)->where('status', true)->get();
        $brands = Brand::get();
        $tags = Tags::all();
        return view('backend.product.edit-product', compact('data', 'category_data', 'size_quantity', 'brands', 'tags'));
    }

    public function editProducts(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'specification' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            // 'quantity' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png|max:10000',
            'product_images.*' => 'mimes:jpeg,jpg,png|max:10000',
            'old_product_images' => 'nullable',
            'size_quantity.*' => 'required',
            'brand' => 'required',
            'material' => 'required|string',
            'shipping' => 'required|numeric|min:0',
            'tags' => 'nullable|array',
        ], [
            'category.required' => 'The category field is required.',
            'name.required' => 'The product name field is required.',
            'specification.required' => 'The specification field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a numeric value.',
            'discount.numeric' => 'The discount must be a numeric value.',
            // 'quantity.required' => 'The quantity field is required.',
            // 'quantity.numeric' => 'The quantity must be a numeric value.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
            'product_images.mimes' => 'The product images must have a valid JPEG, JPG, or PNG file.',
            'product_images.max' => 'The product images must not exceed 10MB in size.',
            'size_quantity.*.required' => 'The size and quantity field is required.',
            'brand.required' => 'The brand field is required.',
            'material.required' => 'The material field is required.',
            'shipping.required' => 'The shipping field is required.',
            'shipping.numeric' => 'The shipping must be a numeric value.',
            'shipping.min' => 'The shipping must be a positive value.',
            'tags.string' => 'The tags must be a string value.',
        ]);

        $id = $request->id;

        $update = Products::where('id', '=', $id)->first();

        if (isset($request->image)) {
            // delete old image
            unlink(public_path('Product_images/' . $update->image));
            unlink(public_path('Product_thumbnails/' . $update->image));
            // Upload Image to folder
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('Product_images'), $imageName);
            Image::make(public_path('Product_images/' . $imageName))->fit(300, 300)->save(public_path('Product_thumbnails/' . $imageName));
            $update->image = $imageName;
        }

        $update->category_id = $request->category;
        $update->product_name = $request->name;
        $update->specification = $request->specification;
        $update->price = $request->price;
        $update->shipping = $request->shipping;
        $update->discount = $request->discount;
        $update->material = $request->material;
        $update->brand_id = $request->brand;
        $update->tags = $request->tags;

        // SizeQuantity::where('products_id', '=', $id)->delete();

        // if ($request->size_quantity != null) {
        //     $size_quantity = $request->size_quantity;
        //     if (count($size_quantity) % 2 == 0) {
        //         for ($i = 0; $i < count($size_quantity); $i += 2) {
        //             SizeQuantity::create([
        //                 'size' => $size_quantity[$i],
        //                 'quantity' => $size_quantity[$i + 1],
        //                 'products_id' => $update->id,
        //             ]);
        //         }
        //     }
        // }

        // ******************************************************************Size Quantity Logic******************************************************************
        $newKeys = $request->ids;
        $oldKeys = SizeQuantity::where('products_id', '=', $id)->where('status', true)->pluck('id')->toArray();
        $size_quantity = $request->size_quantity;

        // updateing the existing size and quantity entries
        for ($i = 0; $i < count($newKeys); $i++) {

            SizeQuantity::where('id', '=', $newKeys[$i])->update([
                'size' => $size_quantity[$i * 2],
                'quantity' => $size_quantity[($i * 2) + 1],
            ]);

            $size_quantity[$i] = null;
            $size_quantity[$i + 1] = null;

        }

        // adding new size and quantity entries
        if ($size_quantity != null) {
            if (count($size_quantity) % 2 == 0) {
                for ($i = 0; $i < count($size_quantity); $i += 2) {
                    if ($size_quantity[$i] != null && $size_quantity[$i + 1] != null) {
                        SizeQuantity::create([
                            'size' => $size_quantity[$i],
                            'quantity' => $size_quantity[$i + 1],
                            'products_id' => $update->id,
                        ]);
                    }
                }
            }
        }

        // deleting the size and quantity entries
        $deleteKeys = array_diff($oldKeys, $newKeys);
        foreach ($deleteKeys as $deleteKey) {
            SizeQuantity::where('id', '=', $deleteKey)->update([
                'status' => false,
            ]);
        }
        // ******************************************************************Size Quantity Logic******************************************************************

        if ($request->old_product_images == null) {
            // unlink all
            foreach ($update->product_images as $product_image) {
                unlink(public_path('Product_images/' . $product_image));
            }
            $productImages = [];
        } else {
            $diff = array_diff($update->product_images, $request->old_product_images);

            // unlink deleted product images
            foreach ($diff as $product_image) {
                unlink(public_path('Product_images/' . $product_image));
            }
            $productImages = $request->old_product_images;
        }


        // Upload Product Images to folder
        if ($request->has('product_images')) {
            foreach ($request->product_images as $product_image) {
                $productImageName = time() . rand(100, 999) . '.' . $product_image->extension();
                $product_image->move(public_path('Product_images'), $productImageName);
                array_push($productImages, $productImageName);
            }
        }

        $update->product_images = $productImages;

        $status = $update->save();

        if ($status) {
            $notification = array(
                'message' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-products')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-products')->with($notification);
        }
    }

    public function deleteProduct($id)
    {
        $product = Products::where('id', '=', $id)->first();
        $product->visible = 'false';
        $product->save();

        $del = Products::where('id', '=', $id)->delete();

        if ($del) {
            $notification = array(
                'message' => 'Product moved to Trash',
                'alert-type' => 'success'
            );
            return redirect()->route('show-products')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-products')->with($notification);
        }
    }


    public function restoreProduct($id)
    {
        $restore = Products::withTrashed()->find($id)->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Product restored Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }

    public function restoreAllProduct()
    {
        $restore = Products::onlyTrashed()->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Restored All Trashed Products',
                'alert-type' => 'success'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }

    public function forceDeleterProduct($id)
    {

        $product = Products::where('id', '=', $id)->withTrashed()->first();

        // check if the image exists in the folder
        if (file_exists(public_path('Product_images/' . $product->image))) {
            unlink(public_path('Product_images/' . $product->image));
            unlink(public_path('Product_thumbnails/' . $product->image));
        }

        // check if the product images exists in the folder
        foreach ($product->product_images as $product_image) {
            if (file_exists(public_path('Product_images/' . $product_image))) {
                unlink(public_path('Product_images/' . $product_image));
            }
        }

        $fdelete = Products::where('id', '=', $id)->withTrashed()->forceDelete();

        if ($fdelete) {
            $notification = array(
                'message' => 'Product Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }

    public function deleteAllProduct()
    {

        $products = Products::onlyTrashed()->get();

        // check if the image exists in the folder
        foreach ($products as $product) {
            if (file_exists(public_path('Product_images/' . $product->image))) {
                unlink(public_path('Product_images/' . $product->image));
                unlink(public_path('Product_thumbnails/' . $product->image));
            }
            foreach ($product->product_images as $product_image) {
                if (file_exists(public_path('Product_images/' . $product_image))) {
                    unlink(public_path('Product_images/' . $product_image));
                }
            }
        }

        $delete_all = Products::onlyTrashed()->forceDelete();

        if ($delete_all) {
            $notification = array(
                'message' => 'Deleted All Trashed Products',
                'alert-type' => 'success'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-products', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }

    public function visibleChangeProduct(Request $request, $id)
    {

        $product = Products::where('id', '=', $id)->first();

        if ($product->visible == '' || $product->visible == 'false') {
            $c = 'true';
        } else {
            $c = 'false';
        }

        $product->visible = $c;
        $product->save();

        // $count = Products::where('visible', '=', 'true')->count();

        // return response()->json(['message' => $count]);

    }

    public function latestChangeProduct(Request $request, $id)
    {

        $product = Products::where('id', '=', $id)->first();

        if ($product->latest == 0) {
            $c = 1;
        } else {
            $c = 0;
        }

        $product->latest = $c;
        $product->save();

        // $count = Products::where('visible', '=', 'true')->count();

        // return response()->json(['message' => $count]);

    }

}
