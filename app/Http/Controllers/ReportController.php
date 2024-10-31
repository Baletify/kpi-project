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

        if ($semester && $year) {
            $employee = Employee::find($id);
            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik')
                ->where('actuals.employee_id', $id)
                ->where('actuals.semester', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->get();
            return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee, 'actuals' => $actuals]);
        } else {
            $employee = Employee::find($id);
            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik')
                ->where('actuals.employee_id', $id)->get();

            return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee, 'actuals' => $actuals]);
        }
    }

    public function department()
    {
        return view('report.department-report', ['title' => 'Report', 'desc' => 'Department']);
    }
}
