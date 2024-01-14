<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Employee;

class TaskEmployeeController extends Controller
{
    public function attachEmployee(Request $request, $taskId, $employeeId)
    {
        $task = Task::findOrFail($taskId);
        $employee = Employee::findOrFail($employeeId);

        $task->Employee()->attach($employee);

        return response()->json(['message' => 'Employee attached to the task successfully'], 200);
    }

    public function detachEmployee($taskId, $employeeId)
    {
        $task = Task::findOrFail($taskId);
        $employee = Employee::findOrFail($employeeId);

        $task->Employee()->detach($employee);

        return response()->json(['message' => 'Employee detached from the task successfully'], 200);
    }
}
