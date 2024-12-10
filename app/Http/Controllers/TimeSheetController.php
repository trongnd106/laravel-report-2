<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException; 

class TimeSheetController extends Controller{
    public function getAll(){
        try {
            $timesheets = Timesheet::with('user')->get();
            return response()->json($timesheets, 200);
        } catch(Exception $e){
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function create(Request $request){
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'work_date' => 'required|date',
                'check_in' => 'required|date_format:H:i:s',
                'check_out' => 'required|date_format:H:i:s',
                'hours_worked' => 'required|numeric|min:0',
            ]);
            // $timesheet = Timesheet::create([
            //     'user_id' => $validatedData['user_id'],
            //     'work_date' => $validatedData['work_date'],
            //     'check_in' => $validatedData['check_in'],
            //     'check_out' => $validatedData['check_out'],
            //     'hours_worked' => $validatedData['hours_worked'],
            // ]);
            $timesheet = Timesheet::create($request->all());
            return response()->json($timesheet, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation Error', 'errors' => $e->errors()], 422);
        } catch(Exception $e){
            // Ghi log chi tiết
            Log::error('Error creating timesheet', ['exception' => $e]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
    
}
