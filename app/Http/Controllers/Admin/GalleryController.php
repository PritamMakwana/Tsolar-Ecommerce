<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageGallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function show()
    {
        $data = ImageGallery::paginate(10);
        return view('backend.gallery.show', compact('data'));
    }


    public function addPageGallery()
    {
        return view('backend.gallery.add-gallery');
    }

    public function addGallery(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
        ], [
            'image.required' => 'Image field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
        ]);

        // Upload Image to folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('gallery_images'), $imageName);

        $insert = ImageGallery::create([
            'image' => $imageName,
        ]);

        if ($insert) {
            $notification = array(
                'message' => 'Image Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('gallery.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('gallery.show')->with($notification);
        }
    }



    public function deleteGallery($id)
    {

        $sel = ImageGallery::where('id', '=', $id)->first();
        if (file_exists(public_path('gallery_images/' . $sel->image))) {
            unlink(public_path('gallery_images/' . $sel->image));
        }

        $del = ImageGallery::where('id', '=', $id)->delete();

        if ($del) {
            $notification = array(
                'message' => 'Image Deleted',
                'alert-type' => 'success'
            );
            return redirect()->route('gallery.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('gallery.show')->with($notification);
        }
    }
}
