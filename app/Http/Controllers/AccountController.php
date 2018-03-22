<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function showMyAccount()
    {
        return view('account')->with([
            'user' => Auth::user(),
            'timezones' => \DateTimeZone::listIdentifiers(\DateTimeZone::ALL)
        ]);
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

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|string|max:255',
            'display_name'  => 'nullable|string|max:255',
            'email'         => 'required|email'
        ]);

        $user = Auth::user();

        if($request->input('sort_reverse') == 'on')
        {
            $user->sort_reverse = 1;
        } else {
            $user->sort_reverse = 0;
        }

        $user->name         = $request->input('name');
        $user->display_name = $request->input('display_name');
        $user->email        = $request->input('email');
        $user->save();

        return redirect()->back()->with("success","Account changed successfully.");

    }
}
