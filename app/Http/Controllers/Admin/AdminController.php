<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use PharIo\Manifest\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Validation\Rules\Exists;

class AdminController extends Controller
{
    public function check(request $request)
    {

        $request->validate(
            [
                'email' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:30',
            ],
            [
                'email.exists' => 'This email is not exists',
            ]
        );

        $creds = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login')->with('fail', 'Incorrect Credentials');
        }
    }
    public function logout()
    {
        // dd(Auth::logout());
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
