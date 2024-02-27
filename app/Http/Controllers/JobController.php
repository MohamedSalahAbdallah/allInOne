<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

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
        $job = new Job();
        $job->code = $request->code;
        $job->name = $request->name;
        $job->description = $request->description;
        $job->status = $request->status;
        $job->department_id = $request->department_id;
        $job->subDepartment_id = $request->subDepartment_id;

        $job->save();
        return response()->json($job);
    }

    // job update
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $job->code = $request->code;
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
