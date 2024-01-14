<?php

namespace Tests\Feature;

use App\Http\Controllers\GroupEmployeeController;
use App\Models\employees;
use App\Models\group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class GroupEmployee extends TestCase
{
    use RefreshDatabase;
    public function testAttachEmployee()
{
    // Arrange
    $group = Group::factory()->create();
    $employee = employees::factory()->create();
    $request = Request::create('/some-url', 'POST');

    // Act
    $response = (new GroupEmployeeController())->attachEmployee($request, $group->id, $employee->id);

    // Assert
    $response->assertStatus(200);
    $this->assertDatabaseHas('employee_group', [
        'group_id' => $group->id,
        'employee_id' => $employee->id,
    ]);
}

public function testDetachEmployee()
{
    // Arrange
    $group = Group::factory()->create();
    $employee = employees::factory()->create();

    $group->employees()->attach($employee);
    $request = Request::create('/some-url', 'POST');

    // Act
    $response = (new GroupEmployeeController())->detachEmployee($group->id, $employee->id);

    // Assert
    $response->assertStatus(200);
    $this->assertDatabaseMissing('employee_group', [
        'group_id' => $group->id,
        'employee_id' => $employee->id,
    ]);
}

}
