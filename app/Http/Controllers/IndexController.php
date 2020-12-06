<?php

namespace App\Http\Controllers;
use App\Laboratory;
use App\Student;
use App\Log;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function freelab() {
		$labs = Laboratory::all();
		return view('freelab')->with('labs', $labs);
	}

	public function postfreelab(Request $request) {

		$student = new Student;
		$student->fullName = $request->input('lastname').', '.$request->input('firstname').' '.$request->input('mi').'.';
		$student->studentNumber = $request->input('sn');
		$student->course = $request->input('course');
		$student->section = $request->input('section');
		$student->lab = $request->input('lab');
		$student->in = $request->input('in');
		$student->out = $request->input('out');

		$student->save();

		return redirect('/freelab');
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
