<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Validator;

class StudyProgramController extends Controller
{
    //constructor
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    //index
    public function index()
    {
        //get all study program
        $studyPrograms = StudyProgram::all();
        //response with message and data
        return response()->json([
            'message' => 'Study programs retrieved successfully',
            'data' => $studyPrograms
        ], 200);
    }

    //show
    public function show($id)
    {
        //find study program by id
        $studyProgram = StudyProgram::find($id);

        if (!$studyProgram) {
            return response()->json([
                'message' => 'Study program not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Study program retrieved successfully',
            'data' => $studyProgram
        ], 200);
    }
    //store
    public function store(Request $request)
    {
        //validator, name study_program_code, study_program_level
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'study_program_code' => 'required|string|max:255',
            'study_program_level' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //create study program, masukkan semua name, description, faculty_id, head_of_study_program, study_program_code, study_program_level, study_program_type, study_program_duration
        $studyProgram = StudyProgram::create([
            'name' => $request->name,
            'description' => $request->description,
            'faculty_id' => $request->faculty_id,
            'head_of_study_program' => $request->head_of_study_program,
            'study_program_code' => $request->study_program_code,
            'study_program_level' => $request->study_program_level,
            'study_program_type' => $request->study_program_type,
            'study_program_duration' => $request->study_program_duration
        ]);

        return response()->json([
            'message' => 'Study program created successfully',
            'study_program' => $studyProgram
        ], 201);
    }
    
}
