<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $employees = DB::table('employees')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department')
            ->get();

        $deptLists = DB::table('departments')->get();


        $manager = Employee::where('status', '=', 'Manager')->count();
        $asstMng = Employee::where('status', '=', 'Staff')->count();
        $monthly = Employee::where('status', '=', 'Monthly')->count();

        $actualManager = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->where('employees.status', '=', 'Manager')
            ->whereMonth('actuals.date', '=', value: $month)
            ->whereYear('actuals.date', '=', value: $year)
            ->count();

        $actualAsstManager = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->where('employees.status', '=', 'Staff')
            ->whereMonth('actuals.date', '=', value: $month)
            ->whereYear('actuals.date', '=', value: $year)
            ->count();

        $actualMonthly = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->where('employees.status', '=', 'Monthly')
            ->whereMonth('actuals.date', '=', value: $month)
            ->whereYear('actuals.date', '=', value: $year)
            ->count();

        // dd($actualMonthly, $actualAsstManager, $actualManager);

        $notification = DB::table('notifications')->orderBy('created_at', 'desc')
            ->first();

        return view('dashboard', [
            'title' => 'Dashboard',
            'desc' => 'Analytics',
            'employees' => $employees,
            'deptLists' => $deptLists,
            'notification' => $notification,
            'manager' => $manager,
            'asstMng' => $asstMng,
            'monthly' => $monthly,
            'actualManager' => $actualManager,
            'actualAsstManager' => $actualAsstManager,
            'actualMonthly' => $actualMonthly
        ]);
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
