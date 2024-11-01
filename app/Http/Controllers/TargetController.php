<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\TargetUnit;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class TargetController extends Controller
{
    public function index()
    {
        $employees = DB::table('employees')->leftJoin('departments', 'employees.department_id', '=', 'departments.id')->leftJoin('targets', 'employees.id', '=', 'targets.employee_id')
            ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department')->distinct()->get();

        return view('/target/input-target-employee', ['title' => 'Input KPI Target', 'desc' => 'Employees', 'employees' => $employees]);
    }

    public function show(Request $request)
    {
        $employeeID = $request->query('employee');
        $departments = $request->query('department');

        if ($employeeID) {
            $employee = Employee::find($employeeID);
            $targets = DB::table('targets')->leftJoin('target_units', 'target_units.id', '=', 'targets.target_unit_id')->where('employee_id', $employeeID)->get();

            return view('target.input-target-kpi', ['title' => 'Input KPI Target', 'desc' => 'Employees', 'employee' => $employee, 'targets' => $targets]);
        } else if ($departments) {
            $departments = DB::table('departments')->where('departments.id', $departments)
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.name as employee', 'employees.nik as nik', 'employees.occupation as occupation', 'departments.name as department')
                ->get();

            return view('target.input-target-department', ['title' => 'Input KPI Target', 'desc' => 'Department', 'departments' => $departments]);
        } else {

            return view('target.input-target-department', ['title' => 'Input KPI Target', 'desc' => 'Department']);
        }
    }
}
