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
        $employees = DB::table('employees')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department')
            ->get();

        $deptLists = DB::table('departments')->get();

        // Count of employees by occupation
        $employeeCountsByOccupation = DB::table('employees')
            ->select('occupation', DB::raw('count(*) as total'))
            ->groupBy('occupation')
            ->get();

        // Total actual inputs for the current month by department
        $currentMonth = Carbon::now()->month;
        $actualInputsByDepartment = DB::table('actuals')
            ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->select('departments.name', DB::raw('count(*) as total'), 'employees.occupation as occupation')
            ->whereMonth('actuals.date', $currentMonth)
            ->groupBy('departments.name', 'employees.name', 'employees.occupation')
            ->get();

        $managerCount = $employeeCountsByOccupation->firstWhere('occupation', 'BSKP Staff')->total ?? 0;
        $assistantManagerCount = $employeeCountsByOccupation->firstWhere('occupation', 'IT Staff')->total ?? 0;
        $totalEmployees = $employees->count();

        $managerCountActual = $actualInputsByDepartment->firstWhere('occupation', 'BSKP Staff')->total ?? 0;
        $assistantManagerCountActual = $actualInputsByDepartment->firstWhere('occupation', 'IT Staff')->total ?? 0;

        $totalActualInputs = $actualInputsByDepartment->sum('total');
        return view('dashboard', [
            'title' => 'Dashboard',
            'desc' => 'Analytics',
            'employees' => $employees,
            'managerCount' => $managerCount,
            'assistantManagerCount' => $assistantManagerCount,
            'totalEmployees' => $totalEmployees,
            'totalActualInputs' => $totalActualInputs,
            'managerCountActual' => $managerCountActual,
            'assistantManagerCountActual' => $assistantManagerCountActual,
            'deptLists' => $deptLists,
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
