<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function index()
	{
		if (Auth::check()) {
            return back();
        }
        return view('login');
    }

    public function login(Request $request)
    {
    	$credentials = $request->validate([
    		'email' => 'required|email',
        	'password' => 'required',
    	]);

    	if (Auth::attempt($credentials)) {

        	$request->session()->regenerate();
        	return redirect()->intended('/events');
    	}

    	return back()->withErrors([
        	'email' => 'The provided credentials do not match our records.',
    	]);
	}

	public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
