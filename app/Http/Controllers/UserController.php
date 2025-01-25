<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\RegisterRequest;
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

    public function store(RegisterRequest $request)
    {
        $attributes = $request->validated();


        if ($request->hasFile('thumbnail')) {
            try {
                $uniqueName = uniqid() . '-' . $request->file('thumbnail')->getClientOriginalName();
                $thumbnailPath = $request->file('thumbnail')->storeAs('images', $uniqueName, 'public');
                $attributes['thumbnail'] = $thumbnailPath;
            } catch (\Exception $e) {
                return back()->withErrors(['thumbnail' => 'File upload failed. Please try again.']);
            }
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

    public function passwordUpdate(PasswordRequest $request)
    {
        $attributes = $request->validated();

        if (!Hash::check($attributes['old_password'], Auth::user()->password)) {
            return back()->with('error', 'The current password is incorrect.');
        }

        Auth::user()->update([
            'password' => Hash::make($attributes['new_password']),
        ]);

        return redirect()->route('user.profile')->with('message', 'Password Updated!');
    }


}
