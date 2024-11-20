<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//model semester
use App\Models\Semester;

class SemesterController extends Controller
{
    //index all
    public function index()
    {
        //ambil semua data semester
        $semester = Semester::all();
        //return data dgn message
        return response()->json([
            'message' => 'success',
            'data' => $semester
        ]);
    }

    //show by id
    public function show($id)
    {
        //ambil data semester by id
        $semester = Semester::find($id);
        //jika data tidak ada
        if (!$semester) {
            //return message
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
        //return data dgn message
        return response()->json([
            'message' => 'success',
            'data' => $semester
        ]);
    }

    //store data
    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'year' => 'required'
        ]);
        //simpan data
        $semester = Semester::create($request->all());
        //return data dgn message
        return response()->json([
            'message' => 'success',
            'data' => $semester
        ]);
    }

    //update data
    public function update(Request $request, $id)
    {
        //validasi
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'year' => 'required'
        ]);
        //ambil data semester by id
        $semester = Semester::find($id);
        //jika data tidak ada
        if (!$semester) {
            //return message
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
        //update data
        $semester->update($request->all());
        //return data dgn message
        return response()->json([
            'message' => 'success',
            'data' => $semester
        ]);
    }

    //delete data
    public function destroy($id)
    {
        //ambil data semester by id
        $semester = Semester::find($id);
        //jika data tidak ada
        if (!$semester) {
            //return message
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
        //hapus data
        $semester->delete();
        //return message
        return response()->json([
            'message' => 'success'
        ]);
    }
}
