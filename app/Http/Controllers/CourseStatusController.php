<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseStatus;
use Illuminate\Support\Facades\Auth;

class CourseStatusController extends Controller {

	public function show() {
		$user = Auth::user(); // или auth()->user()

		$status = CourseStatus::where('user_id', $user->id)->firstOrFail();

		return response()->json($status->only(['a1', 'a2', 'b1', 'b2', 'c1', 'c2']));
	}

	public function updateCourse(Request $request)
	{
		$request->validate([
			'course' => 'required|in:a1,a2,b1,b2,c1,c2',
			'value'  => 'required|boolean',
		]);

		$user = Auth::user(); // или auth()->user()

		$status = CourseStatus::where('user_id', $user->id)->firstOrFail();
		$status->{$request->course} = $request->value;
		$status->save();

		return response()->json(['message' => 'Course status updated.']);
	}
}
