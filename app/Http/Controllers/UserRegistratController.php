<?php

namespace App\Http\Controllers;

use App\Models\CourseStatus;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRegistratController extends Controller {

	public function create(Request $request) {
		$validator = Validator::make($request->all(), [
			'name'     => 'required|string|max:255',
			'login'    => 'required|string|max:255',
			'email'    => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:8|confirmed',
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors(), 422);
		}

		$user = User::create([
			'name'     => $request->name,
			'login'    => $request->login,
			'email'    => $request->email,
			'password' => Hash::make($request->password),
		]);

		CourseStatus::create([
			'user_id' => $user->id,
		]);

		$token = $user->createToken('auth_token')->plainTextToken;

		return response()->json([
			'message'      => 'User registered successfully',
			'user'         => $user,
			'access_token' => $token,
			'token_type'   => 'Bearer',
		], 201);
	}

}
