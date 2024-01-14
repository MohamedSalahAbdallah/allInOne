<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\client;

class clientController extends Controller
{
    public function index()
    {
        return client::all();
    }

    public function show($id)
    {
        return client::find($id);
    }

    public function store(Request $request)
    {
        return client::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $task = client::findOrFail($id);
        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        client::findOrFail($id)->delete();

        return response()->json(['message' => 'Clint deleted successfully']);
    }
}
