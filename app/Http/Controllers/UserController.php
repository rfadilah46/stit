<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//model User
use App\Models\User;
//model UserDetail
use App\Models\UserDetail;

class UserController extends Controller
{
    //index_all_users
    public function index_all_users(Request $request)
    {
        $role = $request->role;
        //get all users, role sesuai role (%like %), jika role tidak ada maka ambil semua, except role superadmin
        $users = User::where('role', 'like', '%' . $role . '%')->where('role', '!=', 'superadmin')
                //join dengan tabel user_detail
                ->join('user_details', 'users.id', '=', 'user_details.user_id')
                //ambil di user_detail.photo
                ->select('users.*', 'user_details.photo')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $users
        ], 200);
    }

    //show_one_user
    public function show_one_user($id)
    {
        //get user by id
        $user = User::find($id);
        //get user detail by user_id
        $user_detail = UserDetail::where('user_id', $id)->first();

        //gambahkan pada $user_detail "name" dari $user->name
        $user_detail->name = $user->name;
        $user_detail->email = $user->email;
        $user_detail->role = $user->role;

        return response()->json([
            'message' => 'Success',
            'data' => $user_detail
        ], 200);
    }

    //update_user
    public function update_user(Request $request, $id)
    {
        //get user by id
        $user = User::find($id);
        //get user detail by user_id
        $user_detail = UserDetail::where('user_id', $id)->first();
        //update user
        //jika ada foto maka simpan foto ke storage foto_user. namanya lalu diacak sesuai tgl skrg dan detik
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo_name = time() . '.' . $photo->getClientOriginalExtension();
            //move
            $photo->move(public_path('foto_user'), $photo_name);
        }else{
            $photo_name = $user_detail->photo;
        }
        $user->update([
            'name' => $request->name,
        ]);
        //update user detail
        $user_detail->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => $photo_name,
            'birthdate' => $request->birthdate,
            'city_birth' => $request->city_birth,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'last_education' => $request->last_education,
            'admitted_at' => $request->admitted_at,
            'study_program_id' => $request->study_program_id,
            'faculty_id' => $request->faculty_id,
            'blood_type' => $request->blood_type,
            'nationality' => $request->nationality,
            'religion' => $request->religion

        ]);
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
            'data_detail' => $user_detail,
            'photo' => $photo_name
        ], 200);
    }


    //destroy
    public function destroy_user($id)
    {
        //get user by id
        $user = User::find($id);
        //get user detail by user_id
        $user_detail = UserDetail::where('user_id', $id)->first();
        //delete user
        $user->delete();
        //delete user detail
        $user_detail->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}
