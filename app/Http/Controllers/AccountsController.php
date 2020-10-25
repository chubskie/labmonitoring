<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AccountsController extends Controller
{
    function getAccounts() {
		$users = DB::table('users')->get();
		$user = Auth::user();
		return view('accounts')
		->with('users', $users)
		->with('user', $user);
	}

	public function addUser(Request $request){
		$this->validate($request, [
			'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
  
		// Create New Message
		$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = Hash::make($request->input('subject'));
		// Save Message
		$user->save();
  
		// Redirect
		return redirect('/accounts')->with('success', 'Message Sent');
	  }
}
