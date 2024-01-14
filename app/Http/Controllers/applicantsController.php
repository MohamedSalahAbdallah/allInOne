<?php

namespace App\Http\Controllers;
use App\Models\applicants;

use Illuminate\Http\Request;

class applicantsController extends Controller
{
    public function index()
    {
        return applicants::all();
    }

    public function show($id)
    {
        return applicants::find($id);
    }

    public function store(Request $request)
    {
        return applicants::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $task = applicants::findOrFail($id);
        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        applicants::findOrFail($id)->delete();

        return response()->json(['message' => 'aplicant deleted successfully']);
    }
}
