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

        if ($department) {
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
}
