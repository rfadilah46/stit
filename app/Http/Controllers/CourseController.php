<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//model
use App\Models\Course;

class CourseController extends Controller
{
    //store
    public function store(Request $request)
    {
        //validate request
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'sks' => 'required',
            'study_program_id' => 'required',
            'professor_id' => 'required',
            'assistant_professor' => 'required',
            'semester' => 'required',
            'faculty_id' => 'required'
        ]);

        //create course
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'sks' => $request->sks,
            'study_program_id' => $request->study_program_id,
            'professor_id' => $request->professor_id,
            'assistant_professor' => $request->assistant_professor,
            'semester' => $request->semester,
            'faculty_id' => $request->faculty_id
        ]);

        return response()->json([
            'message' => 'Course created successfully',
            'data' => $course
        ], 201);
    }
}
