<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
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

public function login(Request $request){
    $val=Validator::make($request->all(),[
        'email'=>'required|email',
        'password'=>'required|min:6',
    ]);
    if (!$val->fails()) {
        # code...
        if (Employee::where('email',$request->email)&&Employee::where('password',Hash::make($request->password))) {
            # code...
            $driverinfo=Employee::where('email',$request->email)->get();
            return response()->json($driverinfo,200);
        }else{

            return response()->json('invalidArgument',400);
        }
    }else {
        return response()->json($val->errors(),400);
    }
}

public function register(Request $request){

    $request->validate([
       'first_name'=>'required',
       'last_name'=>'required',
       'email'=>'required|email',
       'phone'=>'required|size:11',
       'password'=>'required|min:8',
       'nid'=>'required|size:10',
       'position'=>'required',
       'permanent'=>'required',


    ]);

    //insert

    $Employee = new Employee;
    $Employee->first_name=$request->first_name;
    $Employee->password=Hash::make($request->password);
    $Employee->last_name=$request->last_name;
    $Employee->email=$request->email;
    $Employee->phone=$request->phone;
    $Employee->nid=$request->nid;
    $Employee->position=$request->position;
    $Employee->permanent=$request->permanent;
    $save =$Employee->save();


    if ($save) {
        return response()->json('done',200);
    }else {
        return response()->json('wrong',403);
    }
}

}
