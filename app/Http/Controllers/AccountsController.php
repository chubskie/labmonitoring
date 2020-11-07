<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
class AccountsController extends Controller
{
	public function getAccounts() {
		$users = User::select('id', 'name', 'username')->get();
		$user = Auth::user();
		return view('accounts')
		->with('users', $users)
		->with('user', $user);
	}

	public function addUser(Request $request){
		$this->validate($request, [
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'min:8', 'max:20', 'unique:users'],
			'password' => ['required', 'string', 'min:8'],
		]);

		// Create New User
		$user = new User;
		$user->name = $request->name;
		$user->username = $request->username;
		$user->password = Hash::make($request->password);
		$user->created_at = Carbon::now('+8:00');
		$user->updated_at = Carbon::now('+8:00');
		// Save User
		$user->save();

		$users = User::select('id', 'name', 'username')->orderBy('updated_at', 'desc')->get();

		// Response
		return response()->json(['status' => 'success', 'users' => $users]);
	}

	public function index(Request $request) {
		$duplicates = User::where('username', $request->username)->count();
		if ($duplicates > 0) {
			return response()->json(['msg' => 'This username is already taken']);
		}
		return response()->json(['status' => 'success']);
	}

	public function store(Request $request)
	{
		$request->validate([
			'current_password' => ['required', new MatchOldPassword],
			'new_password' => ['required'],
			'new_confirm_password' => ['same:new_password'],
		]);

		User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

		dd('Password change successfully.');
	}
}
