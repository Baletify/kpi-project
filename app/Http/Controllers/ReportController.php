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

            $targets = DB::table('targets')
                ->select('id', 'code', 'indicator', 'employee_id', 'period', 'unit', 'weighting')
                ->where('employee_id', $id)
                ->get();

            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik', 'actuals.semester as semester', 'actuals.date as year', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.record_file')
                ->where('actuals.employee_id', $id)
                ->where('actuals.semester', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->orderBy(DB::raw('MONTH(actuals.date)'))
                ->get();

            if ($actuals->isEmpty()) {
                abort(404, 'No actuals found for the given year and semester');
            }

            return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee, 'actuals' => $actuals, 'targets' => $targets]);
        } else {

            abort(404, 'No actuals found for the given year and semester');
        }
    }

    public function department(Request $request)
    {
        $department = $request->query('department');

        if ($department) {
            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'employees.occupation as occupation', 'employees.nik as nik', 'actuals.department_name as department')
                ->where('actuals.department_name', $department)->get();

            return view('report.department-report', ['title' => 'Report', 'desc' => 'Department', 'actuals' => $actuals]);
        } else {
            return view('report.department-report', ['title' => 'Report', 'desc' => 'Department']);
        }
    }
}
