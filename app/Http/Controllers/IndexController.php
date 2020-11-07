<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function dashboard() {
		return view('dashboard');
	}

	public function freelab() {
		return view('freelab');
	}

	public function postfreelab() {
		
	}
}
