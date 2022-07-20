<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use PharIo\Manifest\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Validation\Rules\Exists;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'Registration successful');
        } else {
            return redirect()->back()->with('fail', 'Registration failed');
        }
    }

    public function check(request $request)
    {
        //validate request
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:5|max:30',
            ],
            [
                'email.exists' => 'This email is not exists',
            ]
        );

        $creds = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($creds)) {
            return redirect()->route('user.home');
        } else {
            return redirect()->route('user.login')->with('fail', 'Incorrect Credentials');
        }
    }
    public function logout()
    {
        // dd(Auth::logout());
        Auth::guard('web')->logout();
        return redirect('/user');
    }
}
