<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsSubjectsRequest;
use App\Models\Students;
use App\Models\Subjects;

class StudentsSubjectsController extends Controller
{

    public function index()
    {
        $students = Students::with('enrolledSubjects')->get();
        return response()->json(['data' => $students], 200);
    }

    public function store(StudentsSubjectsRequest $request)
    {
        $data = $request->validated();
        $student = Students::find($data['students_id']);
        $subject = Subjects::find($data['subjects_id']);

        if ($student && $subject) {
            if ($student->subjects()->where('subjects.id', $subject->id)->exists()) {
                return response()->json([
                    'error' => 'Subject is already attached to the student',
                ], 400);
            }

            try {
                $student->subjects()->attach($subject->id);
                return response()->json([
                    'message' => 'Subject added successfully',
                    'data' => $student
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to add subject to student',
                    'details' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'error' => 'Student or subject not found',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $student = Students::find($id);

        if ($student) {
            try {
                $student->subjects()->detach();

                return response()->json([
                    'message' => 'Student and enrolled subjects deleted successfully',
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to delete student and enrolled subjects',
                    'details' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'error' => 'Student not found',
            ], 404);
        }
    }
}
