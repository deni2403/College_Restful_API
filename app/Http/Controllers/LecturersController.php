<?php

namespace App\Http\Controllers;

use App\Http\Requests\LecturersRequest;
use App\Models\Lecturers;
use App\Models\Subjects;

class LecturersController extends Controller
{
    public function index()
    {
        $lecturers = Lecturers::all();

        return response()->json([
            'data' => $lecturers
        ], 200);
    }

    public function store(LecturersRequest $request)
    {
        $data = $request->validated();

        if (Lecturers::where('lecturers_id', $data['lecturers_id'])->exists()) {
            return response()->json([
                'message' => 'Lecturer id already exists'
            ], 400);
        } else {
            $lecturer = Lecturers::create($data);
            return response()->json([
                'message' => 'Lecturer created successfully',
                'data' => $lecturer
            ], 201);
        }
    }

    public function show($id)
    {
        $lecturer = Lecturers::find($id);

        if ($lecturer) {
            return response()->json([
                'message' => 'Lecturer found',
                'data' => $lecturer
            ], 200);
        } else {
            return response()->json([
                'message' => 'Lecturer not found'
            ], 404);
        }
    }

    public function update(LecturersRequest $request, $id)
    {
    
        $lecturer = Lecturers::find($id);

        if ($lecturer) {
            $data = $request->validated();
            $lecturer->update($data);
            return response()->json([
                'message' => 'Lecturer updated successfully',
                'data' => $lecturer
            ], 200);
        } else {
            return response()->json([
                'message' => 'Lecturer not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $lecturer = Lecturers::find($id);

        if ($lecturer) {
            Subjects::where('lecturers_id', $lecturer->id)->update(['lecturers_id' => null]);

            $lecturer->delete();
            return response()->json([
                'message' => 'Lecturer deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Lecturer not found'
            ], 404);
        }
    }

    public function lecturersWithoutSubjects()
    {
        $lecturers = Lecturers::doesntHave('subjects')->get();

        return response()->json([
            'data' => $lecturers
        ], 200);
    }
}
