<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        $user = User::find(auth()->id());

        return view('profiles.user', compact('user'));
    }

    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'thumbnail' => 'nullable|image'
        ]);


        if ($request->hasFile('thumbnail')) {
            $uniqueName = uniqid() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $thumbnailPath = $request->file('thumbnail')->storeAs('images', $uniqueName, 'public');
            $attributes['thumbnail'] = $thumbnailPath;
        }

        $user = User::create($attributes);

        Auth::login($user);

        return redirect()->route('login');
    }

    public function forgotPassword($id)
    {
        $user = User::find($id);

        if ($user) {
            $newPassword = Str::random(10);
            $user->password = bcrypt($newPassword);
            $user->save();

            Mail::to($user->email)->send(new ForgotPassword([
                'email' => $user->email,
                'password' => $newPassword,
            ]));

            return redirect()->back()->with('message', 'Please check your email for the new password.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }



    public function passwordEdit()
    {
        return view('profiles.change_user_password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with('error', 'The current password is incorrect.');
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('user.profile')->with('message', 'Password Updated!');
    }

}
