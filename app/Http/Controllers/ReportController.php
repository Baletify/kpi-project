<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function show($id, Request $request)
    {
        $semester = $request->query('semester');
        $year = $request->query('year');
        $employee = Employee::find($id);

        if (!$employee) {
            abort(404, 'Employee not found');
        }


        if ($semester && $year) {

            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik', 'actuals.semester as semester', 'actuals.date as year')
                ->where('actuals.employee_id', $id)
                ->where('actuals.semester', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->get();

            if ($actuals->isEmpty()) {
                abort(404, 'No actuals found for the given year and semester');
            }


            return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee, 'actuals' => $actuals]);
        } else {
            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik')
                ->where('actuals.employee_id', $id)->get();

            if ($actuals->isEmpty()) {
                abort(404, 'No actuals found for the given year and semester');
            }
            return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee, 'actuals' => $actuals]);
        }
    }

    public function department(Request $request)
    {
        $department = $request->query('department');

        if ($department) {
            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik', 'actuals.department_name as department')
                ->where('actuals.department_name', $department)->get();

            return view('report.department-report', ['title' => 'Report', 'desc' => 'Department', 'actuals' => $actuals]);
        } else {
            return view('report.department-report', ['title' => 'Report', 'desc' => 'Department']);
        }
    }
}
