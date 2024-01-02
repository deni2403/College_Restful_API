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
        return response()->json($students, 200);
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
                $student->subjects()->attach($subject->id, ['created_at' => now(), 'updated_at' => now()]);
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

    public function show($id)
    {
        $student = Students::with('enrolledSubjects')->find($id);
        if ($student) {
            return response()->json([
                'message' => 'Student found',
                'data' => $student
            ], 200);
        } else {
            return response()->json([
                'error' => 'Student not found',
            ], 404);
        }
    }

    public function update(StudentsSubjectsRequest $request, $id)
    {
        $data = $request->validated();
        $student = Students::find($id);

        if ($student) {
            $subjectsToUpdate = $data['subjects_id'];

            try {
                $student->subjects()->sync($subjectsToUpdate, ['created_at' => now(), 'updated_at' => now()]);

                return response()->json([
                    'message' => 'Subjects updated successfully',
                    'data' => $student->enrolledSubjects
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to update subjects for the student',
                    'details' => $e->getMessage()
                ], 500);
            }
        } else {
            return response()->json([
                'error' => 'Student not found',
            ], 404);
        }
    }

    public function destroy(StudentsSubjectsRequest $request,$id)
    {
        $student = Students::find($id);

        if ($student) {
            $data = $request->validated();
            $subjectsToDelete = $data['subjects_id'];

            try {
                $student->subjects()->detach($subjectsToDelete);

                return response()->json([
                    'message' => 'Subjects deleted successfully',
                    'data' => $student->enrolledSubjects
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to delete subjects for the student',
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
