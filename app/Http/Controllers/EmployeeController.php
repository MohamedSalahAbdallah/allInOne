<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

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

        'name'=>'required',
        'name_ar'=>'required',
        'nid' => 'required|numeric',
        'personal_image' => 'required|image',
        'date_of_birth' => 'required|date',
        'gender' => 'required|string',
        'nationality' => 'required|string',
        'marital_status' => 'required|string',
        'religion' => 'required|string',
        'criminal_case' => 'required|image',
        'id_card_front' => 'required|image',
        'id_card_back' => 'required|image',
        'country' => 'required|string',
        'state' => 'required|string',
        'address' => 'required|string',
        'current_country' => 'required|string',
        'current_state' => 'required|string',
        'current_address' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'password' => 'required|string',
        'facebook' => 'nullable|url',
        'linkedin' => 'nullable|url',
        'main_language' => 'required|string',
        'secondary_language' => 'nullable|string',
        'first_skill' => 'required|string',
        'first_skill_duration' => 'required|string',
        'training_name' => 'nullable|string',
        'training_duration' => 'nullable|string',
        'training_certificate' => 'nullable|image',
        'experience' => 'required|string',
        'job_id'=>'required|numeric'




    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }


    $keysToCopy = ['personal_image', 'criminal_case','id_card_front','id_card_back', 'training_certificate'];

    $destinationArray = [];
    $namelist=[];
    foreach ($keysToCopy as $key) {
        if (isset($request[$key])) {
            $destinationArray[$key] = $request[$key];
        }
    }

    foreach ($destinationArray as $aimage) {
        $image = $aimage;
        $imageName = $image.$request->name .'.' . $image->extension();
        $image->move(public_path('emp_pics'), $imageName);
        $namelist[]=$imageName;

    }

    $Employee = new Employee;
    $Employee->name=$request->name;
    $Employee->name_ar=$request->name_ar;
    $Employee->nid=$request->nid;
    $Employee->personal_image=$namelist[0];
    $Employee->date_of_birth=$request->date_of_birth;
    $Employee->gender=$request->gender;
    $Employee->nationality=$request->nationality;
    $Employee->marital_status=$request->marital_status;
    $Employee->religion=$request->religion;
    $Employee->criminal_case=$namelist[1];
    $Employee->id_card_front=$namelist[2];
    $Employee->id_card_back=$namelist[3];
    $Employee->country=$request->country;
    $Employee->state=$request->state;
    $Employee->address=$request->address;
    $Employee->current_country=$request->current_country;
    $Employee->current_state=$request->current_state;
    $Employee->current_address=$request->current_address;
    $Employee->email=$request->email;
    $Employee->phone=$request->phone;
    $Employee->password=Hash::make($request->password);
    $Employee->facebook=$request->facebook;
    $Employee->linkedin=$request->linkedin;
    $Employee->main_language=$request->main_language;
    $Employee->secondary_language=$request->secondary_language;
    $Employee->first_skill=$request->first_skill;
    $Employee->first_skill_duration=$request->first_skill_duration;
    $Employee->training_name=$request->training_name;
    $Employee->training_duration=$request->training_duration;
    $Employee->training_certificate=$namelist[4];
    $Employee->experience=$request->experience;
    $Employee->job_id=$request->job_id;


    $save =$Employee->save();


    if ($save) {
        return response()->json('done',200);
    }else {
        return response()->json('failed',403);
    }
}


public function whatsApp(Request $request){

    // require_once '/path/to/vendor/autoload.php';

    $sid    = "AC33da0e06e72f6dea0b634ac529726a66";
    $token  = "abda4327fdfa61be09b8d55b33543681";
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("whatsapp:".$request->phone, // to
        array(
          "from" => "whatsapp:+14155238886",
          "body" => 'Your appointment is coming up on July 21 at 3PM'
        )
      );

print($message->sid);
}

}
