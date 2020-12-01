<?php

namespace App\Http\Controllers;

use App\Log;
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

	public function logs() {
		$logs = Log::orderBy('created_at', 'desc')->paginate(50);
		return view('logs', [
			'logs' => $logs
		]);
	}
}
