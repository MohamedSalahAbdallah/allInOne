<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;
use Laravel\Sanctum\Sanctum;




class EmployeeController extends Controller
{
    /**
    * Bootstrap any application services.
    */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(Employee::class);
    }


   /**
 * Get all employees.
 *
 * @return \Illuminate\Database\Eloquent\Collection|Employee[]
 */
public function index()
{

    return Employee::with(['employee_skill','employee_training'])->get();
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
    $employee=Employee::where('id',$request->id)->get();
    $skill=new EmployeeSkill;
    $skill->employee_id=$request->id;
    $skill->name=$request->name;
    $skill->duration=$request->duration;
    $skill->save();


    return response()->json($employee);
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
        'name'=>'required_if:anotherfield,value'
    ]);

    if ($validator->fails()) {
        // If validation fails, return the validation errors
        return response()->json($validator->errors(), 400);
    }

    $employee = Employee::where('email', $request->email)
                    ->first();


    if ($employee && Hash::check($request->password,$employee->password)) {
        $token= $employee->createToken($employee->email)->plainTextToken;

        // If employee exists, return the employee details
        return response()->json($token, 200);
    } else {
        // If employee does not exist, return 'invalidArgument'
        return response()->json('invalidArgument', 400);
    }
}

public function register(Request $request){

    $validator= Validator::make($request->all(),[

        'nameArabic' => 'required|string',
        'nameEnglish' => 'required|string',
        'date' => 'required|date',
        'type' => 'required|string|in:male,female',
        'religion' => 'required|string',
        'nationality' => 'required|string',
        'photoPersonal' => 'required|image',
        'newCountry' => 'required|string',
        'newState' => 'required|string',
        'newAddress' => 'required|string',
        'addressGoogle' => 'required|string',
        'phoneNumber' => 'required|string',
        'homeNumber' => 'nullable|string',
        'email' => 'required|email|unique:employees',
        'password' => 'required|string|min:8',
        'social' => 'nullable|string',
        'mainLanguage' => 'nullable|string',
        'secondLanguage' => 'nullable|string',
        'oneSkill' => 'nullable|string',
        'durationSkill' => 'nullable|string',
        'secSkill' => 'nullable|string',
        'durationSkillTwo' => 'nullable|string',
        'thirdSkill' => 'nullable|string',
        'durationSkillthird' => 'nullable|string',
        'photoCertificates' => 'nullable|string',
        'trainingNameOne' => 'nullable|string',
        'trainingTimeOne' => 'nullable|string',
        'PhotosTrainingCertificateOne' => 'nullable|string',
        'trainingNameSec' => 'nullable|string',
        'trainingTimeSec' => 'nullable|string',
        'PhotosTrainingCertificateSec' => 'nullable|string',
        'trainingNameThird' => 'nullable|string',
        'trainingTimeThird' => 'nullable|string',
        'PhotosTrainingCertificateThird' => 'nullable|string',
        'experience' => 'nullable|string',
        'areaExpertis' => 'nullable|string',
        'howLongExpertise' => 'nullable|string',
        'maritalStatus' => 'nullable|string',
        'healthStatus' => 'nullable|string',
        'nationalId' => 'nullable|string',
        'criminalCase' => 'nullable|string',
        'militaryService' => 'nullable|string',
        'areaExpertise' => 'nullable|string',
        'photoIdCardFront'=>'nullable|string',
        'photoIdCardBack'=>'nullable|string',
        'passportPhoto'=>'nullable|string',
        'numberBassbor'=>'nullable|string',



    ]);

    if ($validator->fails()) {
        return response()->json([$validator->errors()], 422);
    }


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

    $Employee = new Employee;
    $Employee->name=$request->nameEnglish;
    $Employee->name_ar=$request->nameArabic;
    $Employee->nid=$request->nationalId;
    $Employee->personal_image=$request->photoPersonal;
    $Employee->date_of_birth=$request->date;
    $Employee->gender=$request->type;
    $Employee->nationality=$request->nationality;
    $Employee->marital_status=$request->maritalStatus;
    $Employee->religion=$request->religion;
    $Employee->criminal_case=$request->criminalCase;
    $Employee->location=$request->addressGoogle;
    $Employee->health=$request->healthStatus;
    $Employee->military_service=$request->militaryService;
    $Employee->current_country=$request->newCountry;
    $Employee->current_state=$request->newState;
    $Employee->current_address=$request->newAddress;
    $Employee->email=$request->email;
    $Employee->password=Hash::make($request->password);
    $Employee->phone=$request->phoneNumber;
    $Employee->home_number=$request->homeNumber;
    $Employee->social_media=$request->social;
    $Employee->main_language=$request->mainLanguage;
    $Employee->secondary_language=$request->secondLanguage;
    $Employee->first_skill=$request->oneSkill;
    $Employee->first_skill_duration=$request->durationSkill;
    $Employee->second_skill=$request->secSkill;
    $Employee->second_skill_duration=$request->durationSkillTwo;
    $Employee->third_skill=$request->thirdSkill;
    $Employee->third_skill_duration=$request->durationSkillthird;
    $Employee->first_training_name=$request->trainingNameOne;
    $Employee->first_training_duration=$request->trainingTimeOne;
    $Employee->first_training_certificate=$request->PhotosTrainingCertificateOne;
    $Employee->second_training_name=$request->trainingNameSec;
    $Employee->second_training_duration=$request->trainingTimeSec;
    $Employee->second_training_certificate=$request->PhotosTrainingCertificateSec;
    $Employee->third_training_name=$request->trainingNameThird;
    $Employee->third_training_duration=$request->trainingTimeThird;
    $Employee->third_training_certificate=$request->PhotosTrainingCertificateThird;
    $Employee->experience=$request->experience;
    $Employee->area_of_expertise=$request->areaExpertis;
    $Employee->experience_duration=$request->howLongExpertise;
    $Employee->id_card_front=$request->photoIdCardFront;
    $Employee->id_card_back=$request->photoIdCardBack;
    $Employee->passport_image=$request->passportPhoto;
    $Employee->passport_number=$request->numberBassbor;





    $save =$Employee->save();
    $token= $Employee->createToken($Employee->email)->plainTextToken;
    if ($save) {
        return response()->json([$token,$Employee,'success'],201);
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

    //get emplyees who is active
    public function isOnline(Request $request){
        $employee=Employee::where('is_online',true)->get();
        return response()->json($employee,200);
    }

}
