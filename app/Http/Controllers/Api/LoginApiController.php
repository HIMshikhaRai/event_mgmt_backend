<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {

    	$credentials = $request->validate([
    		'email' => 'required|email',
        	'password' => 'required',
    	]);

    	if (Auth::attempt($credentials)) {
			$user = Auth::user();
			$user->remember_token = Str::random(60);
            $user->save();

            return response()->json(['access_token' => $user->remember_token,'email' => $user->email]);
    	}

    	return response()->json([
        	'error' => 'The provided credentials do not match our records.',
    	]);
	}
}
