<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogContoller extends Controller
{
    public function show()
    {
        $data = Blog::paginate(10);
        return view('backend.blog.show', compact('data'));
    }


    public function addPageBlog()
    {
        return view('backend.blog.add-blog');
    }

    public function addBlog(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:10000',
            // This makes 'hyperlink' field optional but if provided, it should be a valid URL
            'hyperlink' => 'nullable|url',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ], [
            'title.required' => 'Title field is required.',
            'description.required' => 'Description field is required.',
            'image.required' => 'Image field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
            'pdf.mimes' => 'The pdf must be a valid PDF file.',
            'pdf.max' => 'The pdf must not exceed 10MB in size.',
        ]);

        // there should be either hyperlink or pdf not both
        if (isset($request->hyperlink) && isset($request->pdf) || !isset($request->hyperlink) && !isset($request->pdf)) {
            $notification = array(
                'message' => 'Either hyperlink or pdf is required.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification)->withInput();
        }

        // Upload Image to folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('blogs_images'), $imageName);

        if (isset($request->pdf)) {
            // Upload PDF to folder
            $pdfName = time() . '.' . $request->pdf->extension();
            $request->pdf->move(public_path('blogs_pdfs'), $pdfName);
        }

        $insert = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'hyperlink' => $request->hyperlink ?? '',
            'pdf' => isset($request->pdf) ? $pdfName : null,
        ]);

        if ($insert) {
            $notification = array(
                'message' => 'Blog Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('blog.show')->with($notification);
        }
    }


    public function editPageBlog($id)
    {
        $fetch = Blog::where('id', '=', $id)->first();
        return view('backend.blog.edit-blog', compact('fetch'));
    }

    public function editBlog(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:10000',
            // This makes 'hyperlink' field optional but if provided, it should be a valid URL
            'hyperlink' => 'nullable|url',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ], [
            'title.required' => 'Title field is required.',
            'description.required' => 'Description field is required.',
            'image.required' => 'Image field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.max' => 'The image must not exceed 10MB in size.',
            'pdf.mimes' => 'The pdf must be a valid PDF file.',
            'pdf.max' => 'The pdf must not exceed 10MB in size.',
        ]);

        $update = Blog::where('id', '=', $request->id)->first();

        // there should be either hyperlink or pdf
        if (isset($request->hyperlink) && isset($request->pdf) || !isset($request->hyperlink) && !isset($request->pdf)) {
            $notification = array(
                'message' => 'Either hyperlink or pdf is required.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification)->withInput();
        }

        if (isset($request->pdf)) {
            // Upload PDF to folder
            $pdfName = time() . '.' . $request->pdf->extension();
            $request->pdf->move(public_path('blogs_pdfs'), $pdfName);

            if (file_exists(public_path('blogs_pdfs/' . $update->pdf) && $update->pdf != '')) {
                unlink(public_path('blogs_pdfs/' . $update->pdf));
            }

            $update->pdf = $pdfName;
        }

        if (isset($request->hyperlink) && $request->hyperlink != '') {
            $update->hyperlink = $request->hyperlink;
            if (file_exists(public_path('blogs_pdfs/' . $update->pdf) && $update->pdf != '')) {
                unlink(public_path('blogs_pdfs/' . $update->pdf));
            }
            $update->pdf = null;
        }

        if (isset($request->image)) {
            // Upload Image to folder

            if (file_exists(public_path('blogs_images/' . $update->image))) {
                unlink(public_path('blogs_images/' . $update->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('blogs_images'), $imageName);
            $update->image = $imageName;

            // check if the image exists in the folder
        }

        $update->title = $request->title;
        $update->description = $request->description;
        // $update->hyperlink = $request->hyperlink ?? '';
        $status = $update->save();


        if ($status) {
            $notification = array(
                'message' => 'Blog Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('blog.show')->with($notification);
        }
    }

    public function deleteBlog($id)
    {

        $blog = Blog::where('id', '=', $id)->first();
        if (file_exists(public_path('blogs_images/' . $blog->image))) {
            unlink(public_path('blogs_images/' . $blog->image));
        }

        $del = Blog::where('id', '=', $id)->delete();

        if ($del) {
            $notification = array(
                'message' => 'Blog Deleted',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('blog.show')->with($notification);
        }
    }

}
