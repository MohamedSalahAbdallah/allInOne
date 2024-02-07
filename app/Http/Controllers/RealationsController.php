<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use App\Models\sector;
use App\Models\SubDepartment;
use App\Models\supplier;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RealationsController extends Controller
{
    public function sectorSuppliers($id)
    {
        $sector = sector::findOrFail($id);
        return Response::json(['data'=>$sector->suppliers]
        ,200) ;
    }

    public function supplierBranches($id)
    {
        $supplier = supplier::findOrFail($id);
        return Response::json(['data'=>$supplier->branches]
        ,200) ;
    }

    public function departmentSupdepartments($id)
    {
        $department = Department::findOrFail($id);
        return Response::json(['data'=>$department->subDepartments]
        ,200) ;
    }

    public function departmentJobs($id)
    {
        $department = Department::findOrFail($id);
        return Response::json(['data'=>$department->jobs]
        ,200) ;
    }

    public function departmentTasks($id)
    {
        $department = Department::findOrFail($id);
        return Response::json(['data'=>$department->tasks]
        ,200) ;
    }

    public function employeeTasks($id)
    {
        $employee = Employee::findOrFail($id);
        return Response::json(['data'=>$employee->tasks]
        ,200) ;
    }

    public function jobEmployees($id)
    {
        $job = Job::findOrFail($id);
        return Response::json(['data'=>$job->employees]
        ,200) ;
    }

    public function subDepartmentJobs($id)
    {
        $subDepartment = SubDepartment::findOrFail($id);
        return Response::json(['data'=>$subDepartment->jobs]
        ,200) ;
    }

    public function subDepartmentTasks($id)
    {
        $subDepartment = SubDepartment::findOrFail($id);
        return Response::json(['data'=>$subDepartment->tasks]
        ,200) ;
    }

    public function taskOrders($id)
    {
        $task = Task::findOrFail($id);
        return Response::json(['data'=>$task->order],200);
    }

    public function userTasks($id)
    {
        $user = User::findOrFail($id);
        return Response::json(['data'=>$user->tasks],200);
    }
}
