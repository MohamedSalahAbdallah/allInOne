<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;

class groupController extends Controller
{
    public function index()
    {
        return group::all();
    }

    public function show($id)
    {
        return group::find($id);
    }

    public function store(Request $request)
    {
        return group::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $task = group::findOrFail($id);
        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        group::findOrFail($id)->delete();

        return response()->json(['message' => 'group deleted successfully']);
    }
}
