<?php

namespace App\Http\Controllers\Seller;


use App\Models\Seller;
use PharIo\Manifest\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function create(Request $request)
    {
        // validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:11|max:15',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',
        ]);
        $seller = new Seller();
        $seller->name = $request->name;
        $seller->phone = $request->phone;
        $seller->email = $request->email;
        $seller->password = Hash::make($request->password);
        $save = $seller->save();

        if ($save) {
            return redirect()->back()->with('success', 'Registration successful');
        } else {
            return redirect()->back()->with('fail', 'Registration failed');
        }
    }
    public function check(request $request)
    {

        $request->validate(
            [
                'email' => 'required|email|exists:sellers,email',
                'password' => 'required|min:5|max:30',
            ],
            [
                'email.exists' => 'This email is not exists',
            ]
        );

        $creds = $request->only('email', 'password');
        if (Auth::guard('seller')->attempt($creds)) {
            return redirect()->route('seller.home');
        } else {
            return redirect()->route('seller')->with('fail', 'Incorrect Credentials');
        }
    }
    public function logout()
    {
        // dd(Auth::logout());
        Auth::guard('seller')->logout();
        return redirect('/seller');
    }
}
