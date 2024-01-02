<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsRequest;
use App\Models\Students;


class StudentsController extends Controller
{   
    public function index()
    {
        $students = Students::all();

        return response()->json([
            'data' => $students
        ], 200);
    }

    public function store(StudentsRequest $request)
    {
        $data = $request->validated();

        if (Students::where('students_id', $data['students_id'])->exists()) {
            return response()->json([
                'message' => 'Student id already exists'
            ], 400);
        } else {
            $student = Students::create($data);
            return response()->json([
                'message' => 'Student created successfully',
                'data' => $student
            ], 201);
        }
    }

    public function show($id)
    {
        $student = Students::find($id);

        if ($student) {
            return response()->json([
                'message' => 'Student found',
                'data' => $student
            ], 200);
        } else {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
    }

    public function update(StudentsRequest $request, $id)
    {
    
        $student = Students::find($id);

        if ($student) {
            $data = $request->validated();
            $student->update($data);
            return response()->json([
                'message' => 'Student updated successfully',
                'data' => $student
            ], 200);
        } else {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $student = Students::find($id);

        if ($student) {
            $student->delete();
            return response()->json([
                'message' => 'Student deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }
    }
}
