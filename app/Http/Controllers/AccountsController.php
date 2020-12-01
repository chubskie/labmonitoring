<?php

namespace App\Http\Controllers;
use App\User;
use App\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
class AccountsController extends Controller
{
	public function getAccounts() {
		$users = User::select('id', 'name', 'username')->orderBy('updated_at', 'desc')->get();
		$user = Auth::user();
		return view('accounts', [
			'users' => $users,
			'user' => $user
		]);
	}

	public function index(Request $request) {
		if ($request->id)
			$duplicates = User::where('username', $request->username)->where('id', '<>', $request->id)->count();
		else
			$duplicates = User::where('username', $request->username)->count();
		if ($duplicates > 0) {
			return response()->json(['msg' => 'This username is already taken']);
		}
		return response()->json(['status' => 'success']);
	}

	public function store(Request $request){
		$this->validate($request, [
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'min:5', 'max:20', 'unique:users'],
			'password' => ['required', 'string', 'min:8'],
		]);

		// Create New User
		$user = new User;
		$user->name = $request->name;
		$user->username = $request->username;
		$user->password = Hash::make($request->password);
		// Save User
		$user->save();

		Log::create([
			'userID' => Auth::id(),
			'description' => 'Added a new user [' . $user->username . ']',
		]);

		$users = User::select('id', 'name', 'username')->orderBy('updated_at', 'desc')->get();

		// Response
		return response()->json(['status' => 'success', 'msg' => 'User [' . $user->username . '] has been created', 'users' => $users]);
	}

	public function edit(Request $request, $id) {
		if ($request->data == 'information') {
			return User::select('username', 'name')->find($id);
		} else if ($request->data == 'new') {
			$user = User::select('password')->find($id);
			if (Hash::check($request->password, $user->password))
				return response()->json(['msg' => 'New password should not be the same as previous one']);
			return response()->json(['status' => 'success']);
		} else {
			$user = User::select('password')->find($id);
			if (Hash::check($request->password, $user->password))
				return response()->json(['status' => 'success']);
			return response()->json(['msg' => 'Incorrect Password']);
		}
	}

	public function update(Request $request, $id) {
		$this->validate($request, [
			'name' => ['required', 'string', 'max:255'],
			'username' => ['required', 'string', 'min:5', 'max:20', 'unique:users'],
		]);

		// Create New User
		$user = User::find($id);
		$user->name = $request->name;
		$user->username = $request->username;
		// Save User
		$user->save();

		$users = User::select('id', 'name', 'username')->orderBy('updated_at', 'desc')->get();

		Log::create([
			'userID' => Auth::id(),
			'description' => 'Updated a user [' . $user->username . ']'
		]);

		// Response
		return response()->json(['status' => 'success', 'msg' => 'User [' . $user->username . '] has been updated', 'users' => $users]);
	}

	public function changepass(Request $request, $id) {
		$user = User::find($id);

		$user->password = Hash::make($request->new);
		$user->save();

		Log::create([
			'userID' => Auth::id(),
			'description' => 'Updated a user [' . $user->username . ']'
		]);

		return response()->json(['msg' => 'Successfully changed password']);
	}

	public function destroy($id) {
		$user = User::find($id);

		$user->delete();

		Log::create([
			'userID' => Auth::id(),
			'description' => 'Deleted a user [' . $user->username . ']'
		]);

		$users = User::select('id', 'name', 'username')->orderBy('updated_at', 'desc')->get();
		return response()->json(['msg' => 'User [' . $user->username . '] has been deleted', 'users' => $users]);
	}
}
