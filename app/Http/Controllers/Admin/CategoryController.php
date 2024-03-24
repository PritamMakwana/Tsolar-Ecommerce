<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    public function showCategories(Request $request)
    {
        $pagi = true;
        $data = Category::paginate(10);

        if ($request->has('view_deleted')) {
            $data = Category::onlyTrashed()->get();
            $pagi = false;
        }

        return view('backend.category.list-categories', compact('data', 'pagi'));

    }

    public function addPageCategory()
    {
        return view('backend.category.add-category');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000'
        ], [
            'name.required' => 'Name field is required.',
            'image.required' => 'Image field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
        ]);

        // Upload Image to folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('category_images'), $imageName);

        $thumbnail = Image::make(public_path('category_images/' . $imageName))->fit(300, 300);
        $thumbnail->save(public_path('category_thumbnails/' . $imageName));

        $name = $request->name;

        $ctr = new Category();
        $ctr->name = $name;
        $ctr->image = $imageName;
        $insert = $ctr->save();

        if ($insert) {
            $notification = array(
                'message' => 'Category Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-categories')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-categories')->with($notification);
        }
    }


    public function editPageCategory($id)
    {
        $fetch = Category::where('id', '=', $id)->first();
        return view('backend.category.edit-category', compact('fetch'));
    }

    public function editCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:10000'
        ], [
            'name.required' => 'Name field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
        ]);

        $id = $request->id;

        $update = Category::where('id', '=', $id)->first();

        if (isset($request->image)) {
            // Delete Image from folder
            if (file_exists(public_path('category_images/' . $update->image))) {
                unlink(public_path('category_images/' . $update->image));
            }
            if (file_exists(public_path('category_thumbnails/' . $update->image))) {
                unlink(public_path('category_thumbnails/' . $update->image));
            }
            // Upload Image to folder
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('category_images'), $imageName);
            Image::make(public_path('category_images/' . $imageName))->fit(300, 300)->save(public_path('category_thumbnails/' . $imageName));
            $update->image = $imageName;
        }

        $update->name = $request->name;
        $status = $update->save();

        if ($status) {
            $notification = array(
                'message' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-categories')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-categories')->with($notification);
        }
    }

    public function deleteCategory($id)
    {

        $category = Category::where('id', '=', $id)->first();
        $category->visible = 'false';
        $category->save();


        $del = Category::where('id', '=', $id)->delete();

        if ($del) {
            $notification = array(
                'message' => 'Category moved to Trash',
                'alert-type' => 'success'
            );
            return redirect()->route('show-categories')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-categories')->with($notification);
        }
    }


    public function restoreCategory($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Category restored Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }

    public function restoreAllCategory()
    {
        $restore = Category::onlyTrashed()->restore();

        if ($restore) {
            $notification = array(
                'message' => 'Restored All Trashed Categories',
                'alert-type' => 'success'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }

    public function forceDeleteCategory($id)
    {
        $cat = Category::where('id', '=', $id)->withTrashed()->first();
        unlink(public_path('category_images/' . $cat->image));
        unlink(public_path('category_thumbnails/' . $cat->image));
        $fdelete = $cat->forceDelete();

        if ($fdelete) {
            $notification = array(
                'message' => 'Category Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }

    public function deleteAllCategory()
    {
        $delete_all = Category::onlyTrashed();

        foreach ($delete_all as $del) {
            if (file_exists(public_path('category_images/' . $del->image))) {
                unlink(public_path('category_images/' . $del->image));
            }
            if (file_exists(public_path('category_thumbnails/' . $del->image))) {
                unlink(public_path('category_thumbnails/' . $del->image));
            }
        }

        $delete_all->forceDelete();

        if ($delete_all) {
            $notification = array(
                'message' => 'Deleted All Trashed Categories',
                'alert-type' => 'success'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-categories', ['view_deleted' => 'DeletedCategories'])->with($notification);
        }
    }


    public function visibleChange(Request $request, $id)
    {

        // $category = Category::where('id', '=', $id)->first();


        // if ($category->visible == '' || $category->visible == 'false') {
        //     $c = 'true';
        // } else {
        //     $c = 'false';
        // }

        // $category->visible = $c;
        // $status = $category->save();

        // $count = Category::where('visible', '=', 'true')->count();

        // return response()->json(['message' => "daw"]);

    }

}
