<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
public function searchByEmail(Request $request)
{
    $request->validate([
        'email' => 'required|string',
    ]);

    $last_name = $request->input('eamil');

    $employees = Employee::where('email', 'like', '%' . $last_name . '%')->get();

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

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    if ($validator->fails()) {
        // If validation fails, return the validation errors
        return response()->json($validator->errors(), 400);
    }

    $employee = Employee::where('email', $request->email)
                    ->first();

    if ($employee && Hash::check($request->password,$employee->password)) {
        // If employee exists, return the employee details
        return response()->json($employee, 200);
    } else {
        // If employee does not exist, return 'invalidArgument'
        return response()->json('invalidArgument', 400);
    }
}

public function register(Request $request){

    $validator= Validator::make($request->all(),[

        'email'=>'required|string',
        'password'=>'required|string',
        'nid'=>'required|numeric',
        'image'=>'required|image',
        'gender'=>'required|string',
        'nationality'=>'required|string',
        'address'=>'required|string',
        'job_type'=>'required|string'

    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    //insert

    $Employee = new Employee;
    $Employee->email = $request->email;
    $Employee->password = Hash::make($request->password);
    $Employee->nid = $request->nid;
    $Employee->image = $request->image;
    $Employee->gender = $request->gender;
    $Employee->nationality = $request->nationality;
    $Employee->address = $request->address;
    $Employee->job_type = $request->job_type;
    $Employee->job_id=$request->job_id;

    $save =$Employee->save();


    if ($save) {
        return response()->json('done',200);
    }else {
        return response()->json('wrong',403);
    }
}

}
