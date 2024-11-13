<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//model
use App\Models\ClassRoom;

class ClassRoomController extends Controller
{
    //index
    public function index()
    {
        //get all class_rooms
        $class_rooms = ClassRoom::all();
        return response()->json([
            'message' => 'Success',
            'data' => $class_rooms
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        //validate request
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        //iff description is null
        if ($request->description == null) {
            $request->description = '';
        }

        //create class_room
        $class_room = ClassRoom::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'message' => 'Class Room created successfully',
            'data' => $class_room
        ], 201);
    }

    //show
    public function show($id)
    {
        //get class_room by id
        $class_room = ClassRoom::find($id);
        return response()->json([
            'message' => 'Success',
            'data' => $class_room
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        //get class_room by id
        $class_room = ClassRoom::find($id);
        //validate request
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);


        //update class_room
        $class_room->name = $request->name;
        $class_room->description = $request->description;
        $class_room->save();

        return response()->json([
            'message' => 'Class Room updated successfully',
            'data' => $class_room
        ], 200);
    }

    //destroy
    public function destroy($id)
    {
        //get class_room by id
        $class_room = ClassRoom::find($id);
        //delete class_room
        $class_room->delete();
        return response()->json([
            'message' => 'Class Room deleted successfully'
        ], 200);
    }
}
