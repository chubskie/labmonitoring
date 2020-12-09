<?php

namespace App\Http\Controllers;
use App\Laboratory;
use App\Student;
use App\Log;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function freelab() {

		$dt = Carbon::now();
		$notAvailable = DB::table('schedules')
			->whereRaw('"'.$dt.'" between `start` and `end`')
			->get();

		 $labs = Laboratory::whereNotIn('id', $notAvailable->pluck('labID'))->get();
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
