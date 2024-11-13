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
            'semester' => 'required',
        ]);

        //jika ada assistant professor tidak ada
        if ($request->assistant_professor == null) {
            $request->assistant_professor = '';
        }

        //if faculty_id is null
        if ($request->faculty_id == null) {
            $request->faculty_id = 0;
        }

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

    //index
    public function index()
    {
        //get all courses, join dengan tabel study_programs.id = courses.study_program_id dan users.id = courses.professor_id
        $courses = Course::join('study_programs', 'study_programs.id', '=', 'courses.study_program_id')
            ->leftJoin('users', 'users.id', '=', 'courses.professor_id')
            ->select('courses.*', 'study_programs.name as study_program_name', 'users.name as professor_name')
            ->get();
        return response()->json([
            'message' => 'Success',
            'data' => $courses
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        //gausah validate
        //find course by id
        $course = Course::find($id);
        //jika course tidak ditemukan
        if ($course == null) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        //jika ada assistant professor tidak ada
        if ($request->assistant_professor == null) {
            $request->assistant_professor = '';
        }

        //if faculty_id is null
        if ($request->faculty_id == null) {
            $request->faculty_id = 0;
        }

        $course = Course::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'sks' => $request->sks,
            'study_program_id' => $request->study_program_id,
            'assistant_professor' => $request->assistant_professor,
            'semester' => $request->semester,
            'professor_id' => $request->professor_id,

        ]);

        return response()->json([
            'message' => 'Course updated successfully',
            'data' => $course
        ], 200);
    }

    //destroy
    public function destroy($id)
    {
        //find course by id
        $course = Course::find($id);
        //jika course tidak ditemukan
        if ($course == null) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        //delete course
        $course->delete();

        return response()->json([
            'message' => 'Course deleted successfully'
        ], 200);
    }
}
