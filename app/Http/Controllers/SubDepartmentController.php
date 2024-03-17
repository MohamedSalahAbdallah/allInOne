<?php

namespace App\Http\Controllers;

use App\Models\SubDepartment;
use Illuminate\Http\Request;

class SubDepartmentController extends Controller
{
    //CRUD APIs

    //index
    public function index() {
        return response(SubDepartment::all());
    }

    //show
    public function show(Request $request , $id) {
        return response()->json(SubDepartment::findOrFail($id));
    }

    //store
    public function store(Request $request){
        $validator=validator($request->all(),[
            'name'=>'required|unique:sub_departments',
            'description'=>'required',
            'department_id' => 'required|exists:departments,id',
            'sub_department_code'=>'required|unique:sub_departments'
        ]);
        if($validator->fails()){
            return response($validator->errors());
        }else {
            $subDepartment = SubDepartment::create($request->all());
            return response()->json($subDepartment);
        }
    }
    //update
    public function update(Request $request , $id){
        $validator=validator($request->all(),[
            'name'=>'required|unique:sub_departments,name,'.$request->id,
            'description'=>'required',
            'department_id' => 'required|exists:departments,id',
            'sub_department_code'=>'required|unique:sub_departments,sub_department_code,'.$request->id
        ]);
        if($validator->fails()){
            return response($validator->errors());
        }else {
            $subDepartment = SubDepartment::findOrFail($id);
            $subDepartment->update($request->all());
            return response()->json($subDepartment);
        }
    }
    //delete

    public function destroy(Request $request , $id){
        $subDepartment = SubDepartment::findOrFail($id);
        $subDepartment->delete();
        return response()->json('Deleted Successfully');
    }
}
