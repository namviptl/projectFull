<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
    	if (auth()->check()) {
    		return redirect()->route('home');
    	}
    	return view('login.index');
    }

    public function postLogin(Request $request)
    {
    	if(auth()->attempt([
    		'email' => $request->email,
    		'password' => $request->password

    	])){
    		return redirect()->route('home');
    	}
    }

    public function logOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
