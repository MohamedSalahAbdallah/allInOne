<?php

namespace App\Http\Controllers;

use App\Models\group;
use App\Models\Employee;
use Illuminate\Http\Request;

class GroupEmployeeController extends Controller
{
    public function attachEmployee(Request $request, $groupId, $employeeId)
    {
        $group = group::findOrFail($groupId);
        $employee = Employee::findOrFail($employeeId);

        $group->Employee()->attach($employee);

        return response()->json(['message' => 'Employee attached to the Group successfully'], 200);
    }

    public function detachEmployee($groupId, $employeeId)
    {
        $group = group::findOrFail($groupId);
        $employee = Employee::findOrFail($employeeId);

        $group->employe()->detach($employee);

        return response()->json(['message' => 'Employee detached from the task successfully'], 200);
    }
}
