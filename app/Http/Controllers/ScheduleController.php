<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//model
use App\Models\Schedule;
//validator
use Illuminate\Support\Facades\Validator;



class ScheduleController extends Controller
{
    //index
    public function index()
    {
        $schedule = Schedule::all();
        return response()->json([
            'success' => true,
            'message' => 'List Schedule',
            'data' => $schedule
        ], 200);
    }

    //show
    public function show($id)
    {
        $schedule = Schedule::findOrfail($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail Schedule',
            'data' => $schedule
        ], 200);
    }

    //store, validate 'name','description','day','start_time','end_time'
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $schedule = Schedule::create([
            'name' => $request->name,
            'description' => $request->description,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        //response success
        return response()->json([
            'success' => true,
            'message' => 'Schedule Created',
            'data' => $schedule
        ], 201);
    }

    //update, validate 'name','description','day','start_time','end_time'
    public function update(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //get schedule by ID
        $schedule = Schedule::findOrfail($id);

        if ($schedule) {
            //update schedule
            $schedule->update([
                'name' => $request->name,
                'description' => $request->description,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Schedule Updated',
                'data' => $schedule
            ], 200);
        }
    }

    //destroy
    public function destroy($id)
    {
        //get schedule by ID
        $schedule = Schedule::findOrfail($id);

        if ($schedule) {
            //delete schedule
            $schedule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Schedule Deleted',
            ], 200);
        }
    }

}
