<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseStatus;
use Illuminate\Support\Facades\Auth;

class CourseStatusController extends Controller {

	/**
	 * Получить статусы курсов текущего пользователя.
	 */
	public function show() {
		$user = Auth::user();

		$status = CourseStatus::where('user_id', $user->id)->firstOrFail();

		return response()->json($status->only(['a1', 'a2', 'b1', 'b2', 'c1', 'c2']));
	}

	/**
	 * Обновить один из курсов пользователя.
	 */
	public function updateCourse(Request $request) {
		$request->validate([
			'course' => 'required|in:a1,a2,b1,b2,c1,c2',
			'value'  => 'required|boolean',
		]);

		$user = Auth::user();

		// Находим запись пользователя
		$status = CourseStatus::where('user_id', $user->id)->firstOrFail();

		// Обновляем выбранный курс
		$status->{$request->course} = $request->value;
		$status->save();

		return response()->json(['message' => 'Статус курса обновлён.']);
	}

	/**
	 * Обновить курс по ID пользователя (если это нужно как админ-функция)
	 */
	public function updateCourseById(Request $request, $id) {
		$request->validate([
			'course' => 'required|in:a1,a2,b1,b2,c1,c2',
			'value'  => 'required|boolean',
		]);

		$status = CourseStatus::where('user_id', $id)->firstOrFail();

		$status->{$request->course} = $request->value;
		$status->save();

		return response()->json(['message' => 'Статус курса обновлён для указанного пользователя.']);
	}
}