<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

   /**
 * Get all employees.
 *
 * @return \Illuminate\Database\Eloquent\Collection|Employee[]
 */
public function index()
{
    return Employee::all();
}

/**
 * Search employees by last name.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Database\Eloquent\Collection|Employee[]
 */
public function searchByName(Request $request)
{
    $request->validate([
        'last_name' => 'required|string',
    ]);

    $last_name = $request->input('last_name');

    $employees = Employee::where('last_name', 'like', '%' . $last_name . '%')->get();

    return $employees;
}

/**
 * Store a new employee.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return Employee
 */
public function store(Request $request)
{
    return Employee::create($request->all());
}

/**
 * Update an existing employee.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return Employee
 */
public function update(Request $request, $id)
{
    $emp = Employee::findOrFail($id);
    $emp->update($request->all());

    return $emp;
}

/**
 * Delete an employee.
 *
 * @param  int  $id
 * @return \Illuminate\Http\JsonResponse
 */
public function destroy($id)
{
    Employee::findOrFail($id)->delete();

    return response()->json(['message' => 'employee deleted successfully']);
}

public function saveEmployeeImage(Request $request, $id)
{
    $employee = Employee::findOrFail($id);

    if ($request->hasFile('image')) {
        $image = $request->file('image');

        // Validate the uploaded file

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a unique file name for the image

        $imageName = time() . '.' . $image->extension();

        // Move the uploaded image to a designated directory

        $image->move(public_path('emp_pic'), $imageName);

        // Save the image file name to the employee record

        $employee->image = $imageName;

        // Save the employee record

        $employee->save();

        return response()->json(['message' => 'Employee image saved successfully']);
    }

    return response()->json(['message' => 'No image file uploaded']);
}

public function getTasksByEmployee(Employee $employee)
{
    $tasks = $employee->task;

    return response()->json($tasks);
}

}
