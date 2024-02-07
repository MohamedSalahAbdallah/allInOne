<?php

use App\Http\Controllers\BranchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskEmployeeController;
use App\Http\Controllers\GroupEmployeeController;
use App\Http\Controllers\groupController;
use App\Http\Controllers\groupTaskController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RealationsController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Models\order;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes/api.php
Route::post("user/gentoken/{email}",[UserController::class,"gentoken"]);
Route::get('/login',function (Request $request) {
    return response()->json('yep');
})->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    // Your authenticated routes here
    Route::get('/employees', [EmployeeController::class, 'index']);
});
// Task routes

/**
 * Get all tasks
 */
Route::get('/tasks', [TaskController::class, 'index']);

// Upload file with task route
Route::post('/tasks/{id}/upload', [TaskController::class, 'uploadFile']);

/**
 * Get a specific task by ID
 *
 * @param int $id The ID of the task
 */
Route::get('/tasks/{id}', [TaskController::class, 'show']);

/**
 * Create a new task
 *
 * @param Request $request The request object
 */
Route::post('/tasks', [TaskController::class, 'store']);

/**
 * Update a task by ID
 *
 * @param int $id The ID of the task
 * @param Request $request The request object
 */
Route::put('/tasks/{id}', [TaskController::class, 'update']);

/**
 * Delete a task by ID
 *
 * @param int $id The ID of the task
 */
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

/**
 * Get groups by task
 *
 *
 */
Route::get('/task/{taskId}/group', [TaskController::class, 'getGroupByTask']); /* not working for now */
// Employee routes

// Get all Employees
// Route::get('/employee', [EmployeeController::class, 'index']);

// Search Employees by name
Route::get('/employee/search', [EmployeeController::class, 'searchByEmail']);

// Create a new employee
Route::post('/employee', [EmployeeController::class, 'store']);

// Update an employee by ID
Route::put('/employee/{id}', [EmployeeController::class, 'update']);

// Delete an employee by ID
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);

// Save an employee's image
Route::post('/employee/{id}/image', [EmployeeController::class, 'saveEmployeeImage']);

// Get tasks by Employee
Route::get('/employee/{employee}/tasks', [EmployeeController::class, 'getTasksByEmployee']);

Route::post('/employee/login', [EmployeeController::class, 'login']);

Route::post('/employee/register', [EmployeeController::class, 'register']);

Route::post('/employee/whats',[EmployeeController::class,'whatsApp']);

// group routes

// Get all groups
Route::get('/groups', [groupController::class, 'index']);

// Get a specific group by ID
Route::get('/groups/{id}', [groupController::class, 'show']);

// Create a new group
Route::post('/groups', [groupController::class, 'store']);

// Update a group by ID
Route::put('/groups/{id}', [groupController::class, 'update']);

// Delete a group by ID
Route::delete('/groups/{id}', [groupController::class, 'destroy']);


// Attach an employee to a group
/**
 * Attach an employee to a group.
 *
 * @param int $groupId The ID of the group.
 * @param int $employeeId The ID of the employee.
 * @return Illuminate\Http\Response
 */
Route::post('/groups/{groupId}/employee/{employeeId}/attach', [GroupEmployeeController::class, 'attachEmployee']);

// Detach an employee from a group
/**
 * Detach an employee from a group.
 *
 * @param int $groupId The ID of the group.
 * @param int $employeeId The ID of the employee.
 * @return Illuminate\Http\Response
 */
Route::delete('/groups/{groupId}/employee/{employeeId}/detach', [GroupEmployeeController::class, 'detachEmployee']);

/**
 * Attach a task to a group.
 *
 * @param int $groupId The ID of the group.
 * @param int $taskId The ID of the task.
 * @return Response
 */
Route::post('/groups/{groupId}/task/{taskId}/attach', [groupTaskController::class, 'attachTask']);

/**
 * Detach a task from a group.
 *
 * @param int $groupId The ID of the group.
 * @param int $taskId The ID of the task.
 * @return Response
 */
Route::delete('/groups/{groupId}/task/{taskId}/detach', [groupTaskController::class, 'detachTask']);

//
// Route::get('/saae');

// saae crud

Route::post('task/taskbyemployee/{employee_id}',[TaskController::class,'showTasksByEmplyeeId']);


//order routes
Route::get('/orders',[OrderController::class,"index"]);
Route::get("/orders/{id}",[OrderController::class,"show"]);
Route::put("/orders/{id}",[OrderController::class,"update"]);
Route::delete("/orders/{id}",[OrderController::class,"destroy"]);
Route::post("/orders",[OrderController::class,"store"]);
Route::post("/orders/tasks/{task_id}",[OrderController::class,"GetOrderByTask"]);

// sectors
// Route::apiResource('/sectors', [SectorController::class]);

Route::apiResources(['/sectors'=>SectorController::class]);
Route::apiResources(['/suppliers'=>SupplierController::class]);
Route::apiResources(['/branches'=>BranchController::class]);
Route::apiResources(['/vehicles'=>VehicleController::class]);

//Realations
Route::get('/sector/{id}/suppliers',[RealationsController::class , 'sectorSuppliers']);
Route::get('/supplier/{id}/branches',[RealationsController::class , 'supplierBranches']);

Route::get('/department/{id}/supdepartments',[RealationsController::class , 'departmentSupdepartments']);
Route::get('/department/{id}/jobs',[RealationsController::class , 'departmentJobs']);
Route::get('/department/{id}/tasks',[RealationsController::class , 'departmentTasks']);

Route::get('/employee/{id}/tasks',[RealationsController::class , 'employeeTasks']);

Route::get('job/{id}/employees' , [RealationsController::class , 'jobEmployees']);

Route::get('subdepartment/{id}/jobs' , [RealationsController::class , 'subDepartmentJobs']);
Route::get('subdepartment/{id}/tasks' , [RealationsController::class , 'subDepartmentTasks']);

Route::get('task/{id}/orders' , [RealationsController::class , 'taskOrders']);

Route::get('user/{id}/tasks' , [RealationsController::class , 'userTasks']);

