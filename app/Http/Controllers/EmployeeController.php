<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        $department = $request->query('department');
        $month = $request->query('month');
        $year = $request->query('year');
        $employee = $request->query('employee');

        if ($employee) {
            $employees = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department')
                ->where('employees.name', 'LIKE', '%' . $employee . '%')
                ->get();


            return view('dashboard', [
                'title' => 'Dashboard',
                'desc' => 'Analytics',
                'employees' => $employees
            ]);
        } else if ($department) {
            $employees = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department')
                ->where('departments.name', $department)
                ->get();

            return view('dashboard', [
                'title' => 'Dashboard',
                'desc' => 'Analytics',
                'employees' => $employees
            ]);
        } else if ($month && $year) {
            $employees = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->leftJoin('actuals', 'employees.id', '=', 'actuals.employee_id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department', 'actuals.date as actual_date')
                ->where(DB::raw('MONTH(actuals.date as actual_date)'), $month)
                ->where(DB::raw('YEAR(actuals.date as actual_date)'), $year)
                ->get();

            return view('dashboard', [
                'title' => 'Dashboard',
                'desc' => 'Analytics',
                'employees' => $employees
            ]);
        } else {
            $employees = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department')
                ->get();

            return view('dashboard', [
                'title' => 'Dashboard',
                'desc' => 'Analytics',
                'employees' => $employees
            ]);
        }
    }
    public function filter(Request $request)
    {
        $department = $request->query('department');
        $name = $request->query('name');
        $year = $request->query('year');
        $semester = $request->query('semester');

        if ($department && $semester && $year) {
            $data = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->leftJoin('actuals', 'employees.id', '=', 'actuals.employee_id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department', 'departments.id as department_id', 'departments.id as department_id', DB::raw('MIN(actuals.date) as actual_date'))
                ->where('actuals.semester', '=', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->where('departments.id', '=', $department)
                ->groupBy('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name', 'departments.id')
                ->get();
            return response()->json($data);
        } else if ($name && $semester && $year) {
            $data = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->leftJoin('actuals', 'employees.id', '=', 'actuals.employee_id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department', 'departments.id as department_id', DB::raw('MIN(actuals.date) as actual_date'))
                ->where('actuals.semester', '=', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->where('employees.name', 'LIKE', '%' . $name . '%')
                ->groupBy('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name', 'departments.id')
                ->get();
            return response()->json($data);
        } else if ($year && $semester) {
            $data = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->leftJoin('actuals', 'employees.id', '=', 'actuals.employee_id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department', 'departments.id as department_id', DB::raw('MIN(actuals.date) as actual_date'))
                ->where('actuals.semester', '=', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->groupBy('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name', 'departments.id')
                ->get();
            return response()->json($data);
        } else if ($name) {
            $data = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('employees.name', 'LIKE', '%' . $name . '%')
                ->get();

            return response()->json($data);
        } else if ($department) {
            $data = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department', 'departments.id as department_id', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->get();

            return response()->json($data);
        }
    }
}
