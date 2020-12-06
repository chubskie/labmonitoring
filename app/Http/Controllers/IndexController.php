<?php

namespace App\Http\Controllers;
use App\Laboratory;
use App\Log;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function freelab() {
		$labs = Laboratory::all();
		return view('freelab')->with('labs', $labs);
	}

	public function postfreelab() {
		
	}

	public function logs(Request $request) {
		// if ($request->search == '') {
		// 	$logs = Log::orderBy('created_at', 'desc')->paginate(50);
		// 	return response()->json(['logs' => $logs]);
		// } else {
		$logs = Log::orderBy('created_at', 'desc')->paginate(50);
		return view('logs', [
			'logs' => $logs
		]);
		// }
	}
}
