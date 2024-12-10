<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentController extends Controller
{
    public function getDetail($id){
        try {
            return Department::findOrFail($id);
        } catch(ModelNotFoundException $e){
            echo $e->getMessage();
        }
    }

    public function getFullData($id){
        try {
            $department = Department::where('id',$id)
                            ->with('users')
                            ->first();
            if(!$department){
                return response()->json(['message' => 'Department not found'],404);
            }
            return response()->json(['data' => $department],200);

        } catch(Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getAll(){
        try {
            $departments = Department::all();
            return $departments;
        } catch(Exception $e){
            return response()->json(['message' => 'Internal server error'],500);
        }
    }
}
