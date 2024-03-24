<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersContoller extends Controller
{
    public function showUsers()
    {
        $data = User::whereHas('role', function ($query) {
            $query->where('role_name', '!=', 'Admin');
        })->paginate(10);

        // dd($data);
        return view('backend.users.list-users', compact('data'));
    }

    public function addPageUser()
    {
        $roles = Role::where('role_name', '!=', 'Admin')->get();
        return view('backend.users.add-user', compact('roles'));
    }

    public function addUser(Request $request)
    {
        // dd($request->role);

        $request->validate([
            'role' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ], [
            'role.required' => 'The role field is required.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ]);

        $user = User::create([
            'role_id' => $request->input('role'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($user) {
            $notification = array(
                'message' => 'User Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-user')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-user')->with($notification);
        }
    }


    public function editPageUser($id)
    {
        $data = User::where('id', '=', $id)->first();
        $roles = Role::where('role_name', '!=', 'Admin')->get();
        return view('backend.users.edit-user', compact('data','roles'));
    }

    public function editUser(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'role.required' => 'The role field is required.',
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
        ]);


        $id = $request->id;
        $update = User::where('id', '=', $id)->first();

        $update->role_id = $request->role;
        $update->name = $request->name;
        $update->email = $request->email;
        $update->password = Hash::make($request->password);


        $status = $update->save();

        if ($status) {
            $notification = array(
                'message' => 'User Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-user')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-user')->with($notification);
        }
    }

    public function deleteUser($id)
    {
        $del = User::where('id', '=', $id)->delete();

        if ($del) {
            $notification = array(
                'message' => 'User Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('show-user')->with($notification);
        } else {
            $notification = array(
                'message' => 'Something went wrong. Please try again!',
                'alert-type' => 'error'
            );
            return redirect()->route('show-user')->with($notification);
        }
    }
}
