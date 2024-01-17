<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\group;

class groupTaskController extends Controller
{
    public function attachTask(Request $request, $taskId, $groupId)
    {
        $task = Task::findOrFail($taskId);
        $group = group::findOrFail($groupId);

        $task->groups()->attach($group);

        return response()->json(['message' => 'group attached to the task successfully'], 200);
    }

    public function detachEmployee($taskId, $groupId)
    {
        $task = Task::findOrFail($taskId);
        $group = group::findOrFail($groupId);

        $group->tasks()->attach($task);

        return response()->json(['message' => 'group detached from the task successfully'], 200);
    }

}
