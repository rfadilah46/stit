<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//model user
use App\Models\User;
//model user_detail
use App\Models\UserDetail;
//model study_program
use App\Models\StudyProgram;

class StudentAreaController extends Controller
{
    //show_profile, dari auth yg sudah login, auth()
    public function show_profile()
    {
        //ambil data user yg sudah login
        $user = auth()->user();
        //$user_data join user yglogin dengan user_detail lalu join dengan study_program ambil study_program.name saja
        $user_data = User::join('user_details', 'users.id', '=', 'user_details.user_id')
            ->join('study_programs', 'user_details.study_program_id', '=', 'study_programs.id')
            ->where('users.id', $user->id)
            ->select('users.id as id_user', 'users.name', 'users.email', 'user_details.*', 'study_programs.name as study_program')
            ->first();
        //return data dgn message
        return response()->json([
            'message' => 'success',
            'data' => $user_data
        ]);
    }

    //save_profile, dari auth yg sudah login, auth()
    public function save_profile(Request $request)
    {
        //ambil data user yg sudah login
        $user = auth()->user();
        //tidak perlu validasi
        //update data user yg sudah login
        $user->name = $request->name;
        $user->save();
        $user_detail = UserDetail::where('user_id', $user->id)->first();
        //jika ada $request->photo, maka simpan photo ke public/foto_user
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            //move
            $photo->move(public_path('foto_user'), $photo_name);
            $user_detail->photo = $photo_name;
        }else{
            $photo_name = $user_detail->photo;
        }
        //update data user_detail yg sudah login, update request->all

        $user_detail->update($request->all());
        $user_detail->update([
            'photo' => $photo_name
        ]);
        $user_detail->save();
        //return data dgn message
        return response()->json([
            'message' => 'success',
            'data' => $user_detail,
            'photo' => $photo_name
        ]);
    }

}
