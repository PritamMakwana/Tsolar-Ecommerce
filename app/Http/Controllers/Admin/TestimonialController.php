<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public function show()
    {
        $data = Testimonial::paginate(10);
        return view('backend.testimonial.show', compact('data'));
    }


    public function addPageTestimonial()
    {
        return view('backend.testimonial.add-testimonial');
    }

    public function addTestimonial(Request $request)
    {
        $request->validate([
            'description' => 'required|max:500',
            'username' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000|dimensions:min_width=612,min_height=408,max_width=612,max_height=408',
        ], [
            'description.required' => 'Description field is required.',
            'description.max' => 'Description must not exceed 500 characters.',
            'username.required' => 'Username field is required.',
            'image.required' => 'Image field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
            'image.dimensions' => 'The image must have a width of 612 pixels and a height of 408 pixels.',
        ]);

        // Upload Image to folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('testimonial_images'), $imageName);

        $insert = Testimonial::create([
            'description' => $request->description,
            'username' => $request->username,
            'image' => $imageName,
        ]);

        if ($insert) {
            $notification = array(
                'message' => 'Testimonial Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('testimonial.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('testimonial.show')->with($notification);
        }
    }


    public function editPageTestimonial($id)
    {
        $fetch = Testimonial::where('id', '=', $id)->first();
        return view('backend.testimonial.edit-testimonial', compact('fetch'));
    }

    public function editTestimonial(Request $request)
    {
        $request->validate([
            'description' => 'required|max:500',
            'username' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:10000|dimensions:min_width=612,min_height=408,max_width=612,max_height=408',
        ], [
            'description.required' => 'Description field is required.',
            'description.max' => 'Description must not exceed 500 characters.',
            'username.required' => 'Username field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
            'image.dimensions' => 'The image must have a width of 612 pixels and a height of 408 pixels.',

        ]);


        $update = Testimonial::where('id', '=', $request->id)->first();


        if (isset($request->image)) {
            // Upload Image to folder

            if (file_exists(public_path('testimonial_images/' . $update->image))) {
                unlink(public_path('testimonial_images/' . $update->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('testimonial_images'), $imageName);
            $update->image = $imageName;

            // check if the image exists in the folder
        }

        $update->description = $request->description;
        $update->username = $request->username;
        $status = $update->save();


        if ($status) {
            $notification = array(
                'message' => 'Testimonial Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('testimonial.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('testimonial.show')->with($notification);
        }
    }

    public function deleteTestimonial($id)
    {

        $testimonial = Testimonial::where('id', '=', $id)->first();
        if (file_exists(public_path('testimonial_images/' . $testimonial->image))) {
            unlink(public_path('testimonial_images/' . $testimonial->image));
        }

        $del = Testimonial::where('id', '=', $id)->delete();

        if ($del) {
            $notification = array(
                'message' => 'Testimonial Deleted',
                'alert-type' => 'success'
            );
            return redirect()->route('testimonial.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('testimonial.show')->with($notification);
        }
    }

}
