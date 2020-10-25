<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AccountsController extends Controller
{
    function getAccounts() {
		$users = DB::table('users')->get();
		$user = Auth::user();
		return view('accounts')
		->with('users', $users)
		->with('user', $user);
	}
}
