<?php

namespace App\Http\Controllers;

use App\Models\Department;
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


        if ($employeeID) {
            $employee = DB::table('employees')->leftJoin('departments', 'departments.id', 'employees.department_id')
                ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department')
                ->where('employees.id', '=', $employeeID)->first();

            $targets = DB::table('targets')->leftJoin('target_units', 'target_units.id', '=', 'targets.target_unit_id')->where('employee_id', $employeeID)->get();

            return view('target.input-target-kpi', ['title' => 'Input KPI Target', 'desc' => 'Employees', 'employee' => $employee, 'targets' => $targets]);
        } else {

            abort(404, 'No actuals found for the given year and semester');
        }
    }

    public function showDept(Request $request)
    {
        $departmentID = $request->query('department');

        if ($departmentID) {
            $dept = DB::table('departments')->where('departments.id', '=', $departmentID)
                ->first();

            if (!$dept) {
                abort(404, 'Department not found');
            }

            $targetDept = DB::table('department_targets')->leftJoin('departments', 'departments.id', '=', 'department_targets.department_id')
                ->leftJoin('target_units', 'department_targets.target_unit_id', '=', 'target_units.id')
                ->select('department_targets.id', 'department_targets.department_id', 'department_targets.target_unit_id', 'department_targets.trend', 'departments.name as department', 'department_targets.code', 'department_targets.indicator', 'department_targets.calculation', 'department_targets.supporting_document', 'department_targets.period', 'department_targets.weighting', 'department_targets.unit', 'target_units.target_1', 'target_units.target_2', 'target_units.target_3', 'target_units.target_4', 'target_units.target_5', 'target_units.target_6', 'target_units.target_7', 'target_units.target_8', 'target_units.target_9', 'target_units.target_10', 'target_units.target_11', 'target_units.target_12')
                ->where('departments.id', '=', $departmentID)->get();

            return view('target.input-target-kpi-department', ['title' => 'Input KPI Target', 'desc' => 'Department', 'departments' => $dept, 'targets' => $targetDept]);
        } else {

            abort(404, 'Not Found');
        }
    }

    public function department(Request $request)
    {
        $departmentID = $request->query('department');

        if ($departmentID) {
            $departments = DB::table('departments')->where('departments.id', $departmentID)
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.name as employee', 'employees.nik as nik', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->get();

            return view('target.input-target-department', ['title' => 'Input KPI Target', 'desc' => 'Department', 'departments' => $departments]);
        } else {
            abort(404, 'No actuals found for the given year and semester');
        }
    }
}
