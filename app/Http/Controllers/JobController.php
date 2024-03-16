<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

    // job index
    public function index()
    {
        return response()->json(Job::all());
    }

    // job store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_code' => 'required|numeric',
            'name' => 'required',
            'description' => 'required',
            'department_id' => 'required|numeric',
            'subDepartment_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }else {
            $job = Job::create($request->all());
            return response()->json($job);
        }
    }

    // job update
    public function update(Request $request, $id)
    {
       $validator = Validator::make($request->all(), [
           'job_code' => 'required|numeric',
           'name' => 'required',
           'description' => 'required',
           'department_id' => 'required|numeric',
           'subDepartment_id' => 'required|numeric'
       ]);

        $job = Job::find($id);
        $job->job_code = $request->code;
        $job->name = $request->name;
        $job->description = $request->description;
        $job->status = $request->status;
        $job->department_id = $request->department_id;
        $job->subDepartment_id = $request->subDepartment_id;
        $job->save();
        return response()->json($job);
    }

    // show a specific resource
    public function show($id)
    {
        return response()->json(Job::find($id));
    }

    // job destroy
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->delete();
        return response()->json($job);
    }


}
