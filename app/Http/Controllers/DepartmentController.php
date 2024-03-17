<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    //index
    public function index(Request $request) {

        return response()->json([
            Department::all(),
        ]);

    }

    //show
    public function show(Request $request , $id) {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    //store
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'department_code' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else {
            $department = new Department();
            $department->department_code = $request->department_code;
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();
            return response()->json([
                'status' => 200,
                'message' => 'Department created successfully',
            ]);
        }
    }

    //update
    public function update(Request $request ,$id) {
        $validator = Validator::make($request->all(), [
            'department_code' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }else {
            $department = Department::findOrFail($id);
            $department->department_code = $request->department_code;
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();
            return response()->json([
                'status' => 200,
                'message' => 'Department updated successfully',
            ]);
        }
    }
    //delete
    public function destroy(Request $request ,$id) {
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Department deleted successfully',
        ]);
    }
}
