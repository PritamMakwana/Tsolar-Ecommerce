<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageBanner;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;


class BannerController extends Controller
{
    public function show()
    {
        $data = HomePageBanner::paginate(10);
        return view('backend.banner.show', compact('data'));
    }


    public function addPageBanner()
    {
        return view('backend.banner.add-banner');
    }

    public function addBanner(Request $request)
    {
        //

        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png|dimensions:min_width=1896,min_height=808,max_width=1896,max_height=808',
        ], [
            'image.required' => 'Image field is required.',
            'image.mimes' => 'The image must be a valid JPEG, JPG, or PNG file.',
            'image.dimensions' => 'The image dimensions must be exactly 1896x808 pixels.',

        ]);

        // Upload Image to folder
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('banner_images'), $imageName);

    // $image = $request->file('image');
    // $filename = time() . '.' . $image->getClientOriginalExtension();
    // $image = Image::make($image)->resize(1439, 808);
    // $image->save(public_path('uploads/' . $filename));

        $insert = HomePageBanner::create([
            'image' => $imageName,
        ]);

        if ($insert) {
            $notification = array(
                'message' => 'Banner Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('banner.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('banner.show')->with($notification);
        }
    }



    public function deleteBanner($id)
    {

        $sel = HomePageBanner::where('id', '=', $id)->first();
        if (file_exists(public_path('banner_images/' . $sel->image))) {
            unlink(public_path('banner_images/' . $sel->image));
        }

        $del = HomePageBanner::where('id', '=', $id)->delete();

        if ($del) {
            $notification = array(
                'message' => 'Banner Deleted',
                'alert-type' => 'success'
            );
            return redirect()->route('banner.show')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('banner.show')->with($notification);
        }
    }
}
