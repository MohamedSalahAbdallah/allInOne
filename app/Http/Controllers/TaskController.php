<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function show($id)
    {
        return Task::find($id);
    }

    public function store(Request $request)
    {
        return Task::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }


    public function getGroupByTask(Task $task){
        $groups = $task->group;


            # code...
            return response()->json($groups);

    }

    public function uploadFile(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');

            // Validate the uploaded file
            $request->validate([
                'file' => 'required|file|max:2048', // Adjust the max size as needed
            ]);

            // Generate a unique file name for the file
            $fileName = time() . '.' . $file->extension();

            // Move the uploaded file to a designated directory (e.g., public/uploads)
            $file->move(public_path('uploads'), $fileName);

            // Save the file name to the employee record or perform other actions as needed
            $task->file = $fileName;

            // Save the employee record with the file name
            $task->save();

            return response()->json(['message' => 'task file saved successfully']);
        }

        // If no file is uploaded
        return response()->json(['message' => 'No file uploaded']);

    }
}
