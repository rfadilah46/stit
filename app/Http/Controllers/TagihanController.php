<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
//validator
use Illuminate\Support\Facades\Validator;

class TagihanController extends Controller
{
    //store_semester_payment
    public function store_semester_payment(Request $request)
    {
        //validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'amount' => 'required',
            'students' => 'required'
        ]);

        //jika validasi gagal
        if ($validator->fails()) {
            //return message error
            return response()->json([
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        //fetch data dari $students yg isinya contohnya {3,4}, jadikan array
        $students = explode(',', $request->students);

        foreach ($students as $student) {
            //simpan data
            $tagihan = Tagihan::create([
                'name' => $request->name,
                'description' => $request->description,
                'amount' => $request->amount,
                'user_id' => $student

            ]);
        }

        //return data dgn message
        return response()->json([
            'message' => 'success',
        ]);

    }

    //index all
    public function index()
    {
        //ambil semua data tagihan, join dengan users berdasarkan user_id
        $tagihan = Tagihan::join('users', 'users.id', '=', 'tagihans.user_id')
            ->select('tagihans.*', 'users.name as student_name')
            ->get();
        //return data dgn message
        return response()->json([
            'message' => 'success',
            'data' => $tagihan
        ]);
    }

    //destroy_semester_payment
    public function destroy_semester_payment($id)
    {
        //hapus data
        $tagihan = Tagihan::find($id);
        //jika data tidak ada
        if (!$tagihan) {
            //return message
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
        //hapus data
        $tagihan->delete();
        //return message
        return response()->json([
            'message' => 'success'
        ]);
    }
}
