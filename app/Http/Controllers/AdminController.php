<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function profiles()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.user_profiles', compact('users'));
    }


    public function profilesEdit($id)
    {
        $user = User::find($id);

        return view('admin.user_profile_edit', compact('user'));
    }

    public function profilesUpdate($id, Request $request)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.profiles')->with('error', 'User not found');
        }

        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'balance' => 'required'
        ]);

        $user->update($attributes);

        return redirect()->route('admin.profiles')->with('message', 'User Updated Successfully');
    }
}
