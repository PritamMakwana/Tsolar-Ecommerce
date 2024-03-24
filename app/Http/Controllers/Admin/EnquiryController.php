<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnquiryController extends Controller
{
    public function index()
    {
        $Enquiry = Enquiry::paginate(10);
        return view('backend.enquiry.list-enquiry', compact('Enquiry'));
    }

    public function destroy($id)
    {
        $Enquiry = Enquiry::find($id);
        $Enquiry->delete();
        $notification = array(
            'message' => 'Enquiry deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
