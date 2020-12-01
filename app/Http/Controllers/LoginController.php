<?php

namespace App\Http\Controllers;

use Auth;
use App\Log;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function login() {
		if (Auth::check())
			return redirect(route('dashboard'));
		return view('login');
	}

	public function postLogin(Request $request) {
		$credentials = $request->only(['username', 'password']);

		if (Auth::attempt($credentials)) {
			Log::create([
				'userID' => Auth::id(),
				'description' => 'Logged in.',
			]);
			return response()->json([
				'status' => 'success',
				'msg' => 'Log In Successful'
			]);
		} else {
			return response()->json([
				'status' => 'fail',
				'msg' => 'Invalid username and/or password'
			]);
		}
	}

	public function logout(Request $request) {
		Log::create([
			'userID' => Auth::id(),
			'description' => 'Logged out.',
		]);
		Auth::logout();
		return redirect(route('login'));
	}
}
