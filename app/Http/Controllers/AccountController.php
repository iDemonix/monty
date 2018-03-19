<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function show()
    {
        return view('account')->with('user', Auth::user());
    }

    public function changePassword(Request $request) 
    {
        if (!(Hash::check($request->input('password_old'), Auth::user()->password))) {
            return redirect()->back()->with('error',"Your current password does not matches with the password you provided. Please try again.");
        }        

        $validatedData = $request->validate([
            'password_old' => 'required',
            'password_new' => 'required|string|min:6|confirmed'
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password_new'));
        $user->save();

        // TODO: flash messages
        return redirect()->back()->with("success","Password changed successfully.");
    }
}
