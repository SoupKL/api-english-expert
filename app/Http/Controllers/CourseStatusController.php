<?php

namespace App\Http\Controllers;

use App\Models\CourseStatus;
use Illuminate\Http\Request;

class CourseStatusController extends Controller
{
    public function show($userId){
        $status = CourseStatus::where('user_id', $userId)->firstOrFail();
        return response()->json($status->only(['a1', 'a2', 'b1', 'b2', 'c1', 'c2']));
    }

    public function updateCourse(Request $request, $userId){
        $request->validate([
            'curse' => 'required|in:a1,a2,b1,b2,c1,c2',
            'value' => 'required|boolean',
        ]);

        $status = CourseStatus::where('$userId', $userId)->firstOrFail();
        $status->{$request->course} = $request->value;
        $status->save();

        return response()->json(['message' => 'Course status updated.']);
    }
}
