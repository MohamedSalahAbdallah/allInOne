<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskEmployeeController;
use App\Http\Controllers\GroupEmployeeController;
use App\Http\Controllers\groupController;
use App\Http\Controllers\groupTaskController;

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
Route::get('/employee', [EmployeeController::class, 'index']);

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

/**
 * Attach an employee to a task.
 *
 * @param int $taskId The ID of the task.
 * @param int $employeeId The ID of the employee.
 * @return \Illuminate\Http\Response
 */
Route::post('/tasks/{taskId}/employee/{employeeId}/attach', [TaskEmployeeController::class, 'attachEmployee']);

/**
 * Detach an employee from a task.
 *
 * @param int $taskId The ID of the task.
 * @param int $employeeId The ID of the employee.
 * @return \Illuminate\Http\Response
 */
Route::delete('/tasks/{taskId}/employee/{employeeId}/detach', [TaskEmployeeController::class, 'detachEmployee']);

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
