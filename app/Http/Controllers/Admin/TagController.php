<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tags;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tags::paginate(10);
        return view('backend.tags.index',compact('tags'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags|max:255',
        ]);

        $tag = new Tags();
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Request $request)
    {
        $tag = Tags::findOrFail($request->id);
        $tag->name = $request->name;
        $tag->save();

        $notification = array(
            'message' => 'Tag updated successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('tags.index')->with($notification);
    }

    public function editTag(Request $request)
    {
        $tag = Tags::findOrFail($request->id);
        return response()->json($tag);
    }

    public function destroy($id)
    {
        $tag = Tags::findOrFail($id);
        $tag->delete();

        $notification = array(
            'message' => 'Tag deleted successfully.',
            'alert-type' => 'success'
        );

        return redirect()->route('tags.index')->with($notification);
    }

}