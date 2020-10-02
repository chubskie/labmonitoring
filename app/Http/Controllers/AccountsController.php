<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
    function getAccounts() {
		return view('accounts');
	}
}
