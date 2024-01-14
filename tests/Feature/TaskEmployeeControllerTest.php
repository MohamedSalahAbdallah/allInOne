<?php

namespace Tests\Feature;

use App\Http\Controllers\TaskEmployeeController;
use App\Models\employees;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class TaskEmployeeControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testAttachEmployee()
{
    // Arrange
    $Task = Task::factory()->create();
    $employee = employees::factory()->create();
    $request = Request::create('/some-url', 'POST');

    // Act
    $response = (new TaskEmployeeController())->attachEmployee($request, $Task->id, $employee->id);

    // Assert
    $response->assertStatus(200);
    $this->assertDatabaseHas('employee_Task', [
        'Task_id' => $Task->id,
        'employee_id' => $employee->id,
    ]);
}

public function testDetachEmployee()
{
    // Arrange
    $Task = Task::factory()->create();
    $employee = employees::factory()->create();

    $Task->employees()->attach($employee);
    $request = Request::create('/some-url', 'POST');

    // Act
    $response = (new TaskEmployeeController())->detachEmployee($Task->id, $employee->id);

    // Assert
    $response->assertStatus(200);
    $this->assertDatabaseMissing('employee_Task', [
        'Task_id' => $Task->id,
        'employee_id' => $employee->id,
    ]);
}

}
