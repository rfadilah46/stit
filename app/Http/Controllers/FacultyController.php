<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//faculty model
use App\Models\Faculty;
//validator
use Illuminate\Support\Facades\Validator;


class FacultyController extends Controller
{
    //constructor
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    //index
    public function index()
    {
        //get all faculty, join dengan tabel users untuk mendapatkan nama dekan
        $faculties = Faculty::join('users', 'faculties.dean_id', '=', 'users.id')
            ->select('faculties.*', 'users.name as dean_name')
            ->get();
        //response with message and data
        return response()->json([
            'message' => 'Faculties retrieved successfully',
            'data' => $faculties
        ], 200);
    }

    //show
    public function show($id)
    {
        //find faculty by id, join dengan tabel users untuk mendapatkan nama dekan
        $faculty = Faculty::join('users', 'faculties.dean_id', '=', 'users.id')
            ->select('faculties.*', 'users.name as dean_name')
            ->where('faculties.id', $id)
            ->first();

        if (!$faculty) {
            return response()->json([
                'message' => 'Faculty not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Faculty retrieved successfully',
            'data' => $faculty
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        //create faculty
        $faculty = Faculty::create([
            'name' => $request->name,
            'description' => $request->description,
            'dean_id' => $request->dean_id
        ]);

        return response()->json([
            'message' => 'Faculty created successfully',
            'data' => $faculty
        ], 201);
    }

    //update
    public function update(Request $request, $id)
    {
        //find faculty by id
        $faculty = Faculty::find($id);

        if (!$faculty) {
            return response()->json([
                'message' => 'Faculty not found'
            ], 404);
        }

        //update faculty
        $faculty->name = $request->name;
        $faculty->description = $request->description;
        $faculty->dean_id = $request->dean_id;
        $faculty->save();

        return response()->json([
            'message' => 'Faculty updated successfully',
            'data' => $faculty
        ], 200);
    }

    //delete
    public function destroy($id)
    {
        //find faculty by id
        $faculty = Faculty::find($id);

        if (!$faculty) {
            return response()->json([
                'message' => 'Faculty not found'
            ], 404);
        }

        //delete faculty
        $faculty->delete();

        return response()->json([
            'message' => 'Faculty deleted successfully'
        ], 200);
    }
}
