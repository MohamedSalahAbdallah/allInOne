<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;




class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    /**

     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(Employee::class);
    }

    // * Bootstrap any application services.
    // */

    // public function boot(): void
    // {
    //     Sanctum::usePersonalAccessTokenModel(Employee::class);
    // }


   /**
 * Get all employees.
 *
 * @return \Illuminate\Database\Eloquent\Collection|Employee[]
 */
//image handling function
public function imageHandle($image,$imageTitle){
    $imageName = time() .$imageTitle.uniqid(). $image->extension(). $image->getClientOriginalName() ;
    $image->move(public_path('images'), $imageName);

    return $imageName;
}
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
        'phone' => 'required|string',
        'password' => 'required|min:8',

    ]);

    if ($validator->fails()) {
        // If validation fails, return the validation errors
        return response()->json($validator->errors(), 400);
    }

    $employee = Employee::where('phone', $request->phone)
                    ->first();
    return response($employee);

    if ($employee && Hash::check($request->password,$employee->password)) {


        // If employee exists, return the employee details
        return response()->json("login success", 200);
    } else {
        // If employee does not exist, return 'invalidArgument'
        return response()->json('invalidArgument', 400);
    }
}

public function register(Request $request){

    $validator= Validator::make($request->all(),[

        'address' => 'required|string',
        'asylamCard' => 'required_if:entryVisa,refugee|image',
        'certificate' => 'required|image',
        'country' => 'required|string',
        'current_address' => 'required|string',
        'current_country' => 'required|string',
        'current_state' => 'required|string',
        'date_of_birth' => 'required|date',
        'email' => 'required|email|unique:employees',
        'entryVisa' => 'required|string',
        'facebook' => 'required|string',
        'gender' => 'required|string',
        'health' => 'required|string',
        'instagram' => 'required|string',
        'integratedServices' => 'required_if:health,disabled|image',
        'landLine' => 'required|string',
        'linkedIn' => 'required|string',
        'main_language' => 'required|string',
        'marital_status' => 'required|string',
        'militaryCertificate' => 'required_if:militaryStatus,complete|image',
        'militaryStatus' => 'required_if:gender,male|string',
        'name' => 'required|string',
        'name_ar' => 'required|string',
        'passport' => 'required_if:id_nationalCard_front,null|required_if:id_nationalCard_back,null|image',
        'phone' => 'required|string|unique:employees',
        'religion' => 'required|string',
        'secondary_language' => 'required|string',
        'state' => 'required|string',
        'id_nationalCard_back' => 'required_if:passport,null|image',
        'id_nationalCard_front' => 'required_if:passport,null|image',
        'nationalId' => 'required_if:nationality,egyptian|string',
        'nationality' => 'required|string',
        'criminalRecord' => 'required|image',
        'password' => 'required|min:8',



    ]);

    if ($validator->fails()) {
        return response()->json([$validator->errors()], 422);
    }
        $employee = new Employee();

        $employee->address = $request->address;
        $employee->email = $request->email;
        if (isset($request->asylumCard)) {
            // Handle the uploaded image
            $employee->asylumCard = $this->imageHandle($request->asylumCard, 'asylumCard'); ;
        }

        if (isset($request->certificate)) {
            $employee->certificate = $this->imageHandle($request->certificate, 'certificate');
        }

        $employee->country = $request->country;
        $employee->current_address = $request->current_address;
        $employee->current_country = $request->current_country;
        $employee->current_state = $request->current_state;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->entryVisa = $request->entryVisa;
        $employee->facebook = $request->facebook;
        $employee->linkedIn = $request->linkedIn;
        $employee->gender = $request->gender;
        $employee->health = $request->health;
        $employee->instagram = $request->instagram;
        if (isset($request->integratedServices)) {
            $employee->integratedServices = $this->imageHandle($request->integratedServices, 'integratedServices');
        }
        $employee->landLine = $request->landLine;
        $employee->main_language = $request->main_language;
        $employee->marital_status = $request->marital_status;
        if (isset($request->militaryCertificate)) {
            $employee->militaryCertificate = $this->imageHandle($request->militaryCertificate, 'militaryCertificate');
        }
        $employee->militaryStatus = $request->militaryStatus;
        $employee->name = $request->name;
        $employee->name_ar = $request->name_ar;
        if (isset($request->passport)) {
            $employee->passport = $this->imageHandle($request->passport, 'passport');
        }
        $employee->phone = $request->phone;
        $employee->religion = $request->religion;
        $employee->secondary_language = $request->secondary_language;
        $employee->state = $request->state;
        if (isset($request->id_nationalCard_back)) {
            $employee->id_nationalCard_back = $this->imageHandle($request->id_nationalCard_back, 'id_nationalCard_back');
        }

        if (isset($request->id_nationalCard_front)) {
            $employee->id_nationalCard_front = $this->imageHandle($request->id_nationalCard_front, 'id_nationalCard_front');
        }
        if (isset($request->criminalRecord)) {
            $employee->criminalRecord = $this->imageHandle($request->criminalRecord, 'criminalRecord');
        }
        $employee->nationalId = $request->nationalId;
        $employee->nationality = $request->nationality;
        $employee->password = Hash::make($request->password);

        $employee->save();
        return response()->json($employee, 200);



    // $keysToCopy = ['personal_image', 'criminal_case','id_card_front','id_card_back', 'training_certificate'];

    // $destinationArray = [];
    // $namelist=[];
    // foreach ($keysToCopy as $key) {
    //     if (isset($request[$key])) {
    //         $destinationArray[$key] = $request[$key];
    //     }
    // }

    // foreach ($destinationArray as $aimage) {
    //     $image = $aimage;
    //     $imageName = $image.$request->name .'.' . $image->extension();
    //     $image->move(public_path('emp_pics'), $imageName);
    //     $namelist[]=$imageName;

    // }

}




// public function whatsApp(Request $request){

//     // require_once '/path/to/vendor/autoload.php';

//     $sid    = "AC33da0e06e72f6dea0b634ac529726a66";
//     $token  = "abda4327fdfa61be09b8d55b33543681";
//     $twilio = new Client($sid, $token);

//     $message = $twilio->messages
//       ->create("whatsapp:".$request->phone, // to
//         array(
//           "from" => "whatsapp:+14155238886",
//           "body" => 'Your appointment is coming up on July 21 at 3PM'
//         )
//       );

// print($message->sid);
// }

}
