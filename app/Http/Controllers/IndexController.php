<?php

namespace App\Http\Controllers;
use App\Laboratory;
use App\Student;
use App\Log;
use Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function freelab() {
		// $labs = DB::table('laboratories')->whereBetween('age', [$ageFrom, $ageTo])->get(); 
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

		$logs = new Log;
		$logs->userID = Auth::id();
		$logs->studentID = Student::pluck('studentID')->last();
		$logs->labID = $request->input('lab');
		$logs->description = "FREE LAB";

		$logs->save();

		return redirect('/freelab');
	}

	public function logs(Request $request) {
		// if ($request->search == '') {
		// 	$logs = Log::orderBy('created_at', 'desc')->paginate(50);
		// 	return response()->json(['logs' => $logs]);
		// } else {
		$logs = Log::with('student','laboratory')->orderBy('created_at', 'desc')->paginate(50);
		return view('logs', [
			'logs' => $logs
		]);
		// }
	}
}
