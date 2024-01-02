<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectsRequest;
use App\Models\Subjects;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subjects::all();

        return response()->json([
            'data' => $subjects
        ], 200);
    }

    public function store(SubjectsRequest $request)
    {
        $data = $request->validated();

        if (Subjects::where('subjects_id', $data['subjects_id'])->exists()) {
            return response()->json([
                'message' => 'Subject id already exists'
            ], 400);
        } else {
            $subject = Subjects::create($data);
            return response()->json([
                'message' => 'Subject created successfully',
                'data' => $subject
            ], 201);
        }
    }

    public function show($id)
    {
        $subject = Subjects::find($id);

        if ($subject) {
            return response()->json([
                'message' => 'Subject found',
                'data' => $subject
            ], 200);
        } else {
            return response()->json([
                'message' => 'Subject not found'
            ], 404);
        }
    }

    public function update(SubjectsRequest $request, $id)
    {

        $subject = Subjects::find($id);

        if ($subject) {
            $data = $request->validated();
            $subject->update($data);
            return response()->json([
                'message' => 'Subject updated successfully',
                'data' => $subject
            ], 200);
        } else {
            return response()->json([
                'message' => 'Subject not found'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $subject = Subjects::find($id);

        if ($subject) {
            $subject->delete();
            return response()->json([
                'message' => 'Subject deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Subject not found'
            ], 404);
        }
    }
}
