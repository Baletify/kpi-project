<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $user = Auth::user();
        $role = $user->role;
        $email = $user->email;
        $departmentID = $user->department_id;

        $div1Dept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'FAD',])->get();
        $div2Dept = DB::table('departments')->whereIn('name', ['Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD'])->get();
        $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
        $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
        $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
        $diva = DB::table('departments')->where('name', '=', 'Sub Div A')->get();
        $divb = DB::table('departments')->where('name', '=', 'Sub Div B')->get();
        $divc = DB::table('departments')->where('name', '=', 'Sub Div C')->get();
        $divd = DB::table('departments')->where('name', '=', 'Sub Div D')->get();
        $dive = DB::table('departments')->where('name', '=', 'Sub Div E')->get();
        $divf = DB::table('departments')->where('name', '=', 'Sub Div F')->get();
        $checker1 = DB::table('departments')->where('id', '=', $departmentID)->get();

        $allDept = Department::all();

        if ($role == 'Checker Div 1') {
            $deptList = $div1Dept;
        } else if ($role == 'Checker Div 2') {
            $deptList = $div2Dept;
        } else if ($role == 'Checker WS') {
            $deptList = $ws;
        } else if ($role == 'Checker Factory') {
            $deptList = $factory;
        } else if ($role == 'Approver' || $role == 'Mng Approver') {
            $deptList = $allDept;
        } elseif ($role == 'Inputer' && $email == 'fsd@bskp.co.id') {
            $deptList = $fsd;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.a@bskp.co.id') {
            $deptList = $diva;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.b@bskp.co.id') {
            $deptList = $divb;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.c@bskp.co.id') {
            $deptList = $divc;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.d@bskp.co.id') {
            $deptList = $divd;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.e@bskp.co.id') {
            $deptList = $dive;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.f@bskp.co.id') {
            $deptList = $divf;
        } elseif ($role == 'Checker 1') {
            $deptList = $checker1;
        } else {
            $deptList = [];
        }

        // dd($deptList, $role, $email, $dive);

        // if ($email == 'sub.divisi.a@bskp.co.id') {
        //     $deptList = $diva;
        // } else if ($email == 'sub.divisi.b@bskp.co.id') {
        //     $deptList = $divb;
        // } else if ($email == 'sub.divisi.c@bskp.co.id') {
        //     $deptList = $divc;
        // } else if ($email == 'sub.divisi.d@bskp.co.id') {
        //     $deptList = $divd;
        // } else if ($email == 'sub.divisi.e@bskp.co.id') {
        //     $deptList = $dive;
        // } else if ($email == 'sub.divisi.f@bskp.co.id') {
        //     $deptList = $divf;
        // } else {
        //     $deptList = [];
        // }



        $manager = Employee::where('status', '=', 'Manager')->count();
        $asstMng = Employee::where('status', '=', 'Staff')->count();
        $monthly = Employee::where('status', '=', 'Monthly')->count();

        $actualManager = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->where('employees.status', '=', 'Manager')
            ->whereMonth('actuals.created_at', '=', value: $month)
            ->whereYear('actuals.created_at', '=', value: $year)
            ->count();

        $actualAsstManager = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->where('employees.status', '=', 'Staff')
            ->whereMonth('actuals.created_at', '=', value: $month)
            ->whereYear('actuals.created_at', '=', value: $year)
            ->count();

        $actualMonthly = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->where('employees.status', '=', 'Monthly')
            ->whereMonth('actuals.created_at', '=', value: $month)
            ->whereYear('actuals.created_at', '=', value: $year)
            ->count();

        // dd($actualMonthly, $actualAsstManager, $actualManager);

        $notification = DB::table('notifications')->orderBy('created_at', 'desc')
            ->first();

        return view('dashboard', [
            'title' => 'Dashboard',
            'desc' => 'Analytics',
            'employees' => $employees,
            'deptLists' => $deptList,
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

        $user = Auth::user();
        $role = $user->role;
        $email = $user->email;

        $div1Dept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'FAD',])->get();
        $div2Dept = DB::table('departments')->whereIn('name', ['Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD'])->get();
        $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
        $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
        $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
        $diva = DB::table('departments')->where('name', '=', 'Sub Div A')->get();
        $divb = DB::table('departments')->where('name', '=', 'Sub Div B')->get();
        $divc = DB::table('departments')->where('name', '=', 'Sub Div C')->get();
        $divd = DB::table('departments')->where('name', '=', 'Sub Div D')->get();
        $dive = DB::table('departments')->where('name', '=', 'Sub Div E')->get();
        $divf = DB::table('departments')->where('name', '=', 'Sub Div F')->get();
        $allDept = Department::all();

        if ($role == 'Checker Div 1') {
            $deptList = $div1Dept;
        } else if ($role == 'Checker Div 2') {
            $deptList = $div2Dept;
        } else if ($role == 'Checker WS') {
            $deptList = $ws;
        } else if ($role == 'Checker Factory') {
            $deptList = $factory;
        } else if ($role == 'Approver' || $role == 'Superadmin') {
            $deptList = $allDept;
        } elseif ($role == 'Inputer' && $email == 'fsd@bskp.co.id') {
            $deptList = $fsd;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.a@bskp.co.id') {
            $deptList = $diva;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.b@bskp.co.id') {
            $deptList = $divb;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.c@bskp.co.id') {
            $deptList = $divc;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.d@bskp.co.id') {
            $deptList = $divd;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.e@bskp.co.id') {
            $deptList = $dive;
        } elseif ($role == 'Inputer' && $email == 'sub.divisi.f@bskp.co.id') {
            $deptList = $divf;
        } else {
            $deptList = collect();
        }

        $deptNames = $deptList->pluck('name')->toArray();

        $department = $request->input('department');
        $name = $request->input('name');
        $year = $request->input('year');
        $semester = $request->input('semester');


        if ($department || $name || $year || $semester) {
            $query = DB::table('employees')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->leftJoin('actuals', 'employees.id', '=', 'actuals.employee_id')
                ->select('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name as department', 'departments.id as department_id', DB::raw('MIN(actuals.date) as actual_date'))
                ->whereIn('departments.name', $deptNames);

            if ($department) {
                $query->where('departments.id', $department);
            }

            if ($name) {
                $query->where('employees.name', 'like', '%' . $name . '%');
            }

            if ($year) {
                $query->whereYear('actuals.date', $year);
            }

            if ($semester) {
                $query->where('actuals.semester', $semester);
            }

            $data = $query->groupBy('employees.id', 'employees.nik', 'employees.name', 'employees.occupation', 'departments.name', 'departments.id')->get();

            return response()->json($data);
        } else {
            // Return an empty response or a default message if no query parameters are provided
            return response()->json([]);
        }
    }
}
