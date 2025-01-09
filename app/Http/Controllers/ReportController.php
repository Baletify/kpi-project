<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Actual;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentActual;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $department = $request->query('department');
        $employee = $request->query('employee');
        $role = $request->role;

        if ($department && $role) {
            if ($role == '') {
                abort(403, 'Unauthorized');
            }

            $div1Dept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C'])->get();
            $div2Dept = DB::table('departments')->whereIn('name', ['Sub Div D', 'Sub Div E', 'Sub Div F'])->get();
            $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
            $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
            $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
            $allDept = Department::all();

            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->get();

            return view('report.list-employee-report', ['title' => 'Report', 'desc' => 'Employee List', 'departments' => $departments, 'div1Dept' => $div1Dept, 'div2Dept' => $div2Dept, 'allDept' => $allDept, 'ws' => $ws, 'factory' => $factory, 'fsd' => $fsd]);
        } else if ($department) {
            $departmentID = Auth::user()->department_id;
            if ($department != $departmentID) {
                abort(403, 'Unauthorized');
            }
            $div1Dept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C'])->get();
            $div2Dept = DB::table('departments')->whereIn('name', ['Sub Div D', 'Sub Div E', 'Sub Div F'])->get();
            $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
            $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
            $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
            $allDept = Department::all();

            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->get();

            return view('report.list-employee-report', ['title' => 'Report', 'desc' => 'Employee List', 'departments' => $departments, 'div1Dept' => $div1Dept, 'div2Dept' => $div2Dept, 'allDept' => $allDept, 'ws' => $ws, 'factory' => $factory, 'fsd' => $fsd]);
        } elseif ($employee) {
            $userID = Auth::user()->id;
            if ($employee != $userID) {
                abort(403, 'Unauthorized');
            }
            $div1Dept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C'])->get();
            $div2Dept = DB::table('departments')->whereIn('name', ['Sub Div D', 'Sub Div E', 'Sub Div F'])->get();
            $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
            $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
            $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
            $allDept = Department::all();

            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('employees.id', $employee)
                ->get();

            return view('report.list-employee-report', ['title' => 'Report', 'desc' => 'Employee List', 'departments' => $departments, 'div1Dept' => $div1Dept, 'div2Dept' => $div2Dept, 'allDept' => $allDept, 'ws' => $ws, 'factory' => $factory, 'fsd' => $fsd]);
        } else {
            return view('components/404-page');
        }
    }

    public function indexDept()
    {
        $user = Auth::user();
        $role = $user->role;

        $div1Dept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'FAD',])->get();
        $div2Dept = DB::table('departments')->whereIn('name', ['Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD'])->get();
        $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
        $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
        $allDept = Department::all();

        if ($role == 'Inputer' || $role == '') {
            abort(403, 'Unauthorized');
        } else if ($role == 'Checker Div 1') {
            $deptList = $div1Dept;
            return view('report.list-department-report', ['title' => 'Report', 'desc' => 'Department List', 'deptList' => $deptList]);
        } else if ($role == 'Checker Div 2') {
            $deptList = $div2Dept;
            return view('report.list-department-report', ['title' => 'Report', 'desc' => 'Department List', 'deptList' => $deptList]);
        } else if ($role == 'Checker WS') {
            $deptList = $ws;
            return view('report.list-department-report', ['title' => 'Report', 'desc' => 'Department List', 'deptList' => $deptList]);
        } else if ($role == 'Checker Factory') {
            $deptList = $factory;
            return view('report.list-department-report', ['title' => 'Report', 'desc' => 'Department List', 'deptList' => $deptList]);
        } else if ($role == 'Approver' || $role == 'Superadmin') {
            $deptList = $allDept;
            return view('report.list-department-report', ['title' => 'Report', 'desc' => 'Department List', 'deptList' => $deptList]);
        }
    }
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
                ->select('id', 'code', 'indicator', 'employee_id', 'period', 'unit', 'weighting', 'trend')
                ->where('employee_id', $id)
                ->where(DB::raw('YEAR(targets.date)'), $year)
                ->get();

            $actuals = DB::table('actuals')
                ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_weighting', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'employees.email as email', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik', 'actuals.semester as semester', 'actuals.date as year', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.record_file', 'actuals.id as actual_id', 'actuals.status as status', 'actuals.trend')
                ->where('actuals.employee_id', $id)
                ->where('actuals.semester', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->orderBy(DB::raw('MONTH(actuals.date)'))
                ->get();

            // sum bobot
            $targetWeightingSum = DB::table('targets')
                ->select('weighting')
                ->where('employee_id', $id)
                ->where(DB::raw('YEAR(targets.date)'), $year)
                ->get();

            $targetWeightingSum->transform(function ($item) {
                $item->weighting = floatval(str_replace('%', '', $item->weighting));
                return $item;
            });

            $sumWeighting = $targetWeightingSum->sum('weighting');



            if ($actuals->isEmpty()) {
                abort(404, 'No actuals found for the given year and semester');
            }



            $groupedData = $actuals->groupBy('kpi_code');


            // Hitung total target dan actual untuk setiap kelompok
            $totals = $groupedData->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $totalPercentage = $group->sum(function ($item) {
                    return (float) $item->kpi_percentage;
                });


                $weight = floatval($group->first()->kpi_weighting); // Ambil bobot dari item pertama dalam grup


                $totalAchievementWeight = $totalPercentage * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'total_percentage' => $totalPercentage,
                    'weight' => $weight,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee, 'actuals' => $actuals, 'targets' => $targets, 'totals' => $totals, 'sumWeighting' => $sumWeighting,]);
        } else {

            return view('components/404-page');
        }
    }

    public function department($id, Request $request)
    {
        $semester = $request->query('semester');
        $year = $request->query('year');

        if ($semester && $year) {

            $targets = DB::table('department_targets')
                ->select('id', 'code', 'indicator', 'department_id', 'period', 'unit', 'weighting', 'trend')
                ->where('department_id', $id)
                ->where(DB::raw('YEAR(department_targets.date)'), $year)
                ->get();

            $actuals = DB::table('department_actuals')
                ->leftJoin('departments', 'department_actuals.department_id', '=', 'departments.id')
                ->select('department_actuals.date as date', 'department_actuals.department_id as department_id', 'department_actuals.kpi_item', 'department_actuals.kpi_code as kpi_code', 'department_actuals.kpi_weighting', 'department_actuals.kpi_percentage as achievement', 'department_actuals.semester as semester', DB::raw('YEAR(department_actuals.date) as year'), 'department_actuals.target', 'department_actuals.actual', 'department_actuals.kpi_percentage', 'department_actuals.record_file', 'department_actuals.id as department_actual_id', 'department_actuals.status as status', 'departments.name as department', 'department_actuals.trend')
                ->where('department_actuals.department_id', $id)
                ->where('department_actuals.semester', $semester)
                ->where(DB::raw('YEAR(department_actuals.date)'), $year)
                ->orderBy(DB::raw('MONTH(department_actuals.date)'))->get();


            if ($actuals->isEmpty()) {
                abort(404, 'No actuals found for the given year and semester');
            }
            // sum bobot
            $targetWeightingSum = DB::table('department_targets')
                ->select('weighting')
                ->where('department_id', $id)
                ->where(DB::raw('YEAR(department_targets.date)'), $year)
                ->get();

            $targetWeightingSum->transform(function ($item) {
                $item->weighting = floatval(str_replace('%', '', $item->weighting));
                return $item;
            });

            $sumWeighting = $targetWeightingSum->sum('weighting');

            // if ($actuals->isEmpty()) {
            //     abort(404, 'No actuals found for the given year and semester');
            // }

            $groupedData = $actuals->groupBy('kpi_code');

            // Hitung total target dan actual untuk setiap kelompok
            $totals = $groupedData->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $totalPercentage = $group->sum(function ($item) {
                    return (float) $item->kpi_percentage;
                });


                $weight = floatval($group->first()->kpi_weighting); // Ambil bobot dari item pertama dalam grup


                $totalAchievementWeight = $totalPercentage * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'total_percentage' => $totalPercentage,
                    'weight' => $weight,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });


            return view('report.department-report', ['title' => 'Report', 'desc' => 'Summary KPI Dept', 'actuals' => $actuals, 'targets' => $targets, 'totals' => $totals, 'sumWeighting' => $sumWeighting,]);
        } else {
            return abort(404, 'Not Found');
        }
    }

    public function summaryDept(Request $request)
    {
        $department = $request->query('department');
        $yearToShow = $request->query('year');
        $status = $request->query('status');
        $allDept = Department::all();
        $allStatus = Employee::select('status')->distinct()->get();

        if ($yearToShow && $department && $status) {
            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id', 'department_id')
                ->where('employees.status', $status)
                ->where('departments.id', $department)
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);

            $actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where('departments.id', $department)
                ->where(DB::raw('YEAR(actuals.date)'), '=', $yearToShow)
                ->get();

            $actualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')->leftJoin('employees', 'department_actuals.department_id', '=', 'employees.department_id')
                ->where('departments.id', $department)
                ->where(DB::raw('YEAR(department_actuals.date)'), '=', $yearToShow)
                ->get();


            $groupedData = $actuals->groupBy(['employee_id', 'semester']);
            $groupedDeptData = $actualsDept->groupBy(['department_id', 'semester']);

            // Hitung total target dan actual untuk setiap kelompok
            $totals = $groupedData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $totalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $totalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $totalPercentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $totalAchievementWeight = $totalPercentage * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'total_percentage' => $totalPercentage,
                        'weight' => $weight,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $deptTotals = $groupedDeptData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $deptTotalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $deptTotalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $deptTotalPercentage = $deptTotalTarget > 0 ? ($deptTotalActual / $deptTotalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $deptTotalAchievementWeight = $deptTotalPercentage * $weight / 100;

                    return [
                        'dept_total_target' => $deptTotalTarget,
                        'dept_total_actual' => $deptTotalActual,
                        'dept_total_percentage' => $deptTotalPercentage,
                        'weight' => $weight,
                        'dept_total_achievement_weight' => $deptTotalAchievementWeight,
                    ];
                });
            });


            // Hitung total bobot pencapaian per karyawan untuk semester 1 dan semester 2
            $employeeTotals = [];
            foreach ($employees as $employee) {
                $semester1Weight = floatval($totals[$employee->employee_id][1]['total_achievement_weight'] ?? 0);
                $semester2Weight = floatval($totals[$employee->employee_id][2]['total_achievement_weight'] ?? 0);
                $semester1DeptWeight = floatval($deptTotals[$employee->department_id][1]['dept_total_achievement_weight'] ?? 0);
                $semester2DeptWeight = floatval($deptTotals[$employee->department_id][2]['dept_total_achievement_weight'] ?? 0);

                $employeeTotals[$employee->employee_id] = [
                    'semester_1' => $semester1Weight,
                    'semester_2' => $semester2Weight,
                    'dept_semester_1' => $semester1DeptWeight,
                    'dept_semester_2' => $semester2DeptWeight,
                    'total' => ($semester1Weight + $semester2Weight) / 2 * 0.7,
                    'totalDept' => ($semester1DeptWeight + $semester2DeptWeight) / 2 * 0.3,
                ];
            }

            // dd($employeeTotals);


            return view('report.summary-department-report', ['title' => 'Report', 'desc' => 'Department Report', 'employees' => $employees, 'employeeTotals' => $employeeTotals, 'allDept' =>  $allDept, 'allOccupation' => $allStatus]);
        } elseif ($yearToShow && $department) {
            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id', 'department_id')
                ->where('departments.id', $department)
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);

            $actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where('departments.id', $department)
                ->where(DB::raw('YEAR(actuals.date)'), '=', $yearToShow)
                ->get();

            $actualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')->leftJoin('employees', 'department_actuals.department_id', '=', 'employees.department_id')
                ->where('departments.id', $department)
                ->where(DB::raw('YEAR(department_actuals.date)'), '=', $yearToShow)
                ->get();


            $groupedData = $actuals->groupBy(['employee_id', 'semester']);
            $groupedDeptData = $actualsDept->groupBy(['department_id', 'semester']);

            // Hitung total target dan actual untuk setiap kelompok
            $totals = $groupedData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $totalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $totalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $totalPercentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $totalAchievementWeight = $totalPercentage * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'total_percentage' => $totalPercentage,
                        'weight' => $weight,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $deptTotals = $groupedDeptData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $deptTotalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $deptTotalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $deptTotalPercentage = $deptTotalTarget > 0 ? ($deptTotalActual / $deptTotalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $deptTotalAchievementWeight = $deptTotalPercentage * $weight / 100;

                    return [
                        'dept_total_target' => $deptTotalTarget,
                        'dept_total_actual' => $deptTotalActual,
                        'dept_total_percentage' => $deptTotalPercentage,
                        'weight' => $weight,
                        'dept_total_achievement_weight' => $deptTotalAchievementWeight,
                    ];
                });
            });


            // Hitung total bobot pencapaian per karyawan untuk semester 1 dan semester 2
            $employeeTotals = [];
            foreach ($employees as $employee) {
                $semester1Weight = floatval($totals[$employee->employee_id][1]['total_achievement_weight'] ?? 0);
                $semester2Weight = floatval($totals[$employee->employee_id][2]['total_achievement_weight'] ?? 0);
                $semester1DeptWeight = floatval($deptTotals[$employee->department_id][1]['dept_total_achievement_weight'] ?? 0);
                $semester2DeptWeight = floatval($deptTotals[$employee->department_id][2]['dept_total_achievement_weight'] ?? 0);

                $employeeTotals[$employee->employee_id] = [
                    'semester_1' => $semester1Weight,
                    'semester_2' => $semester2Weight,
                    'dept_semester_1' => $semester1DeptWeight,
                    'dept_semester_2' => $semester2DeptWeight,
                    'total' => ($semester1Weight + $semester2Weight) / 2 * 0.7,
                    'totalDept' => ($semester1DeptWeight + $semester2DeptWeight) / 2 * 0.3,
                ];
            }

            return view('report.summary-department-report', ['title' => 'Report', 'desc' => 'Department Report', 'employees' => $employees, 'employeeTotals' => $employeeTotals, 'allDept' => $allDept, 'allOccupation' => $allStatus]);
        } elseif ($yearToShow && $status) {
            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id', 'department_id')
                ->where('employees.status', '=', $status)
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);

            $actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where(DB::raw('YEAR(actuals.date)'), '=', $yearToShow)
                ->get();

            $actualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')->leftJoin('employees', 'department_actuals.department_id', '=', 'employees.department_id')
                ->where(DB::raw('YEAR(department_actuals.date)'), '=', $yearToShow)
                ->get();


            $groupedData = $actuals->groupBy(['employee_id', 'semester']);
            $groupedDeptData = $actualsDept->groupBy(['department_id', 'semester']);

            // Hitung total target dan actual untuk setiap kelompok
            $totals = $groupedData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $totalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $totalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $totalPercentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $totalAchievementWeight = $totalPercentage * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'total_percentage' => $totalPercentage,
                        'weight' => $weight,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $deptTotals = $groupedDeptData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $deptTotalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $deptTotalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $deptTotalPercentage = $deptTotalTarget > 0 ? ($deptTotalActual / $deptTotalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $deptTotalAchievementWeight = $deptTotalPercentage * $weight / 100;

                    return [
                        'dept_total_target' => $deptTotalTarget,
                        'dept_total_actual' => $deptTotalActual,
                        'dept_total_percentage' => $deptTotalPercentage,
                        'weight' => $weight,
                        'dept_total_achievement_weight' => $deptTotalAchievementWeight,
                    ];
                });
            });


            // Hitung total bobot pencapaian per karyawan untuk semester 1 dan semester 2
            $employeeTotals = [];
            foreach ($employees as $employee) {
                $semester1Weight = floatval($totals[$employee->employee_id][1]['total_achievement_weight'] ?? 0);
                $semester2Weight = floatval($totals[$employee->employee_id][2]['total_achievement_weight'] ?? 0);
                $semester1DeptWeight = floatval($deptTotals[$employee->department_id][1]['dept_total_achievement_weight'] ?? 0);
                $semester2DeptWeight = floatval($deptTotals[$employee->department_id][2]['dept_total_achievement_weight'] ?? 0);

                $employeeTotals[$employee->employee_id] = [
                    'semester_1' => $semester1Weight,
                    'semester_2' => $semester2Weight,
                    'dept_semester_1' => $semester1DeptWeight,
                    'dept_semester_2' => $semester2DeptWeight,
                    'total' => ($semester1Weight + $semester2Weight) / 2 * 0.7,
                    'totalDept' => ($semester1DeptWeight + $semester2DeptWeight) / 2 * 0.3,
                ];
            }


            return view('report.summary-department-report', ['title' => 'Report', 'desc' => 'Department Report', 'employees' => $employees, 'employeeTotals' => $employeeTotals, 'allDept' => $allDept, 'allOccupation' => $allStatus]);
        } elseif ($yearToShow) {
            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id', 'department_id')
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);

            $actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where(DB::raw('YEAR(actuals.date)'), '=', $yearToShow)
                ->get();
            $actualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')->leftJoin('employees', 'department_actuals.department_id', '=', 'employees.department_id')
                ->where(DB::raw('YEAR(department_actuals.date)'), '=', $yearToShow)
                ->get();


            $groupedData = $actuals->groupBy(['employee_id', 'semester']);
            $groupedDeptData = $actualsDept->groupBy(['department_id', 'semester']);

            // Hitung total target dan actual untuk setiap kelompok
            $totals = $groupedData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $totalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $totalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $totalPercentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $totalAchievementWeight = $totalPercentage * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'total_percentage' => $totalPercentage,
                        'weight' => $weight,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $deptTotals = $groupedDeptData->map(function ($semesterGroups) {
                return $semesterGroups->map(function ($group) {
                    $deptTotalTarget = $group->sum(function ($item) {
                        return (float) $item->target;
                    });
                    $deptTotalActual = $group->sum(function ($item) {
                        return (float) $item->actual;
                    });
                    $deptTotalPercentage = $deptTotalTarget > 0 ? ($deptTotalActual / $deptTotalTarget) * 100 : 0;

                    $weight = floatval(str_replace('%', '', $group->first()->kpi_weighting)); // Ambil bobot dari item pertama dalam grup dan hilangkan simbol %
                    $deptTotalAchievementWeight = $deptTotalPercentage * $weight / 100;

                    return [
                        'dept_total_target' => $deptTotalTarget,
                        'dept_total_actual' => $deptTotalActual,
                        'dept_total_percentage' => $deptTotalPercentage,
                        'weight' => $weight,
                        'dept_total_achievement_weight' => $deptTotalAchievementWeight,
                    ];
                });
            });


            // Hitung total bobot pencapaian per karyawan untuk semester 1 dan semester 2
            $employeeTotals = [];
            foreach ($employees as $employee) {
                $semester1Weight = floatval($totals[$employee->employee_id][1]['total_achievement_weight'] ?? 0);
                $semester2Weight = floatval($totals[$employee->employee_id][2]['total_achievement_weight'] ?? 0);
                $semester1DeptWeight = floatval($deptTotals[$employee->department_id][1]['dept_total_achievement_weight'] ?? 0);
                $semester2DeptWeight = floatval($deptTotals[$employee->department_id][2]['dept_total_achievement_weight'] ?? 0);

                $employeeTotals[$employee->employee_id] = [
                    'semester_1' => $semester1Weight,
                    'semester_2' => $semester2Weight,
                    'dept_semester_1' => $semester1DeptWeight,
                    'dept_semester_2' => $semester2DeptWeight,
                    'total' => ($semester1Weight + $semester2Weight) / 2 * 0.7,
                    'totalDept' => ($semester1DeptWeight + $semester2DeptWeight) / 2 * 0.3,
                ];
            }


            return view('report.summary-department-report', ['title' => 'Report', 'desc' => 'Department Report', 'employees' => $employees, 'employeeTotals' => $employeeTotals, 'allDept' => $allDept, 'allOccupation' => $allStatus]);
        } else {
            return view('components/404-page');
        }
    }


    public function showFile(Request $request)
    {
        $month = $request->query('month');
        $actualId = $request->query('actual_id');

        $pdfUrls = Actual::whereMonth('date', $month)
            ->where('id', $actualId)
            ->get(['id', 'record_file', 'kpi_code', 'kpi_item', 'status'])
            ->toArray();

        return response()->json($pdfUrls);
    }

    public function showFileDept(Request $request)
    {
        $month = $request->query('month');
        $actualId = $request->query('actual_id');

        $pdfUrls = DepartmentActual::whereMonth('date', $month)
            ->where('id', $actualId)
            ->get(['id', 'record_file', 'kpi_code', 'kpi_item', 'status'])
            ->toArray();

        return response()->json($pdfUrls);
    }
}
