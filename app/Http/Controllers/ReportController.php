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

use function Laravel\Prompts\select;

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

            $divDept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F'])->get();
            $divFAD = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD', 'FSD'])->get();
            $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
            $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
            $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
            $allDept = Department::all();

            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->get();

            return view('report.list-employee-report', ['title' => 'Report', 'desc' => 'Employee List', 'departments' => $departments, 'divDept' => $divDept, 'divFAD' => $divFAD, 'allDept' => $allDept, 'ws' => $ws, 'factory' => $factory, 'fsd' => $fsd]);
        } else if ($department) {
            $departmentID = Auth::user()->department_id;
            if ($department != $departmentID) {
                abort(403, 'Unauthorized');
            }
            $divDept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F'])->get();
            $divFAD = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD', 'FSD'])->get();
            $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
            $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
            $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
            $allDept = Department::all();

            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->get();

            return view('report.list-employee-report', ['title' => 'Report', 'desc' => 'Employee List', 'departments' => $departments, 'divDept' => $divDept, 'divFAD' => $divFAD, 'allDept' => $allDept, 'ws' => $ws, 'factory' => $factory, 'fsd' => $fsd]);
        } elseif ($employee) {
            $userID = Auth::user()->id;
            if ($employee != $userID) {
                abort(403, 'Unauthorized');
            }
            $divDept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F'])->get();
            $divFAD = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD', 'FSD'])->get();
            $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
            $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
            $fsd = DB::table('departments')->where('name', '=', 'FSD')->get();
            $allDept = Department::all();

            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('employees.id', $employee)
                ->get();

            return view('report.list-employee-report', ['title' => 'Report', 'desc' => 'Employee List', 'departments' => $departments, 'divDept' => $divDept, 'divFAD' => $divFAD, 'allDept' => $allDept, 'ws' => $ws, 'factory' => $factory, 'fsd' => $fsd]);
        } else {
            return view('components/404-page');
        }
    }

    public function indexDept()
    {
        $user = Auth::user();
        $role = $user->role;

        $divDept = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F'])->get();
        $divFAD = DB::table('departments')->whereIn('name', ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD', 'FSD'])->get();
        $ws = DB::table('departments')->where('name', '=', 'Workshop')->get();
        $factory = DB::table('departments')->where('name', '=', 'Factory')->get();
        $allDept = Department::all();

        if ($role == 'Inputer' || $role == '') {
            abort(403, 'Unauthorized');
        } else if ($role == 'Checker Div 1' || $role == 'Checker Div 2') {
            $deptList = $divDept;
            return view('report.list-department-report', ['title' => 'Report', 'desc' => 'Department List', 'deptList' => $deptList]);
        } else if ($role == 'FAD') {
            $deptList = $divFAD;
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

    private function calculation($targetZero, $target, $actual, $trend)
    {
        $zeroStatus = $targetZero == 0 ? $zeroStatus = 'yes' : 'no';
        if ($zeroStatus == 'yes') {
            if ($actual == 0) {
                $zeroCalc = '100%';
            } elseif ($actual == 1) {
                $zeroCalc = '75%';
            } elseif ($actual == 2) {
                $zeroCalc = '50%';
            } else if ($actual == 3) {
                $zeroCalc = '25%';
            } else if ($actual == 4) {
                $zeroCalc = '10%';
            } else if ($actual >= 5) {
                $zeroCalc = '0%';
            }
            return $zeroCalc;
        } elseif ($trend == 'Negatif') {
            $negativeVal = $target / $actual * 100;
            return $negativeVal;
        } elseif ($trend == 'Positif') {
            $positiveVal = $actual / $target * 100;
            return $positiveVal;
        } else {
            $positiveVal = $actual / $target * 100;
            return $positiveVal;
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
                ->select('department_actuals.date as date', 'department_actuals.department_id as department_id', 'department_actuals.kpi_item', 'department_actuals.kpi_code as kpi_code', 'department_actuals.kpi_weighting', 'department_actuals.kpi_percentage as achievement', 'department_actuals.semester as semester', DB::raw('YEAR(department_actuals.date) as year'), 'department_actuals.target', 'department_actuals.actual', 'department_actuals.kpi_percentage', 'department_actuals.record_file', 'department_actuals.id as department_actual_id', 'department_actuals.status as status', 'departments.name as department', 'department_actuals.trend', 'department_actuals.kpi_unit')
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
            // dd($groupedData);

            // Hitung total target dan actual untuk setiap kelompok
            $totals = $groupedData->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));


                $weight = floatval($group->first()->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchivementWeight = $convertedCalc * $weight / 100;


                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchivementWeight,
                ];
            });

            // dd($totals);


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
                ->where('departments.id', '=', $department)
                ->where('employees.status', '=', $status)
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);
            // dd($employees);

            $semester1Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '1')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '2')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester1ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '1')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '2')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $actualsGroup1 = $semester1Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsGroup2 = $semester2Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsDeptGroup1 = $semester1ActualsDept->groupBy('kpi_code');
            $actualsDeptGroup2 = $semester2ActualsDept->groupBy('kpi_code');

            $semester1Group = $actualsGroup1->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester2Group = $actualsGroup2->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester1DeptGroup = $actualsDeptGroup1->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            $semester2DeptGroup = $actualsDeptGroup2->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            // dd($semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup);

            // Calculate the sum of total_achievement_weight for each semester group
            $sumSemester1 = $semester1Group->flatten(1)->sum('total_achievement_weight');
            $sumSemester2 = $semester2Group->flatten(1)->sum('total_achievement_weight');
            $sumSemester1Dept = $semester1DeptGroup->sum('total_achievement_weight');
            $sumSemester2Dept = $semester2DeptGroup->sum('total_achievement_weight');

            // dd($employees, $semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup, $sumSemester1, $sumSemester2, $sumSemester1Dept, $sumSemester2Dept);

            return view('report.summary-department-report', [
                'title' => 'Report',
                'desc' => 'Department Report',
                'allDept' => $allDept,
                'allOccupation' => $allStatus,
                'employees' => $employees,
                'semester1Group' => $semester1Group,
                'semester2Group' => $semester2Group,
                'semester1DeptGroup' => $semester1DeptGroup,
                'semester2DeptGroup' => $semester2DeptGroup,
                'sumSemester1' => $sumSemester1,
                'sumSemester2' => $sumSemester2,
                'sumSemester1Dept' => $sumSemester1Dept,
                'sumSemester2Dept' => $sumSemester2Dept,
            ]);
        } elseif ($yearToShow && $department) {
            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id', 'department_id')
                ->where('departments.id', '=', $department)
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);
            // dd($employees);

            $semester1Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '1')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '2')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester1ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '1')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '2')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $actualsGroup1 = $semester1Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsGroup2 = $semester2Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsDeptGroup1 = $semester1ActualsDept->groupBy('kpi_code');
            $actualsDeptGroup2 = $semester2ActualsDept->groupBy('kpi_code');

            $semester1Group = $actualsGroup1->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester2Group = $actualsGroup2->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester1DeptGroup = $actualsDeptGroup1->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            $semester2DeptGroup = $actualsDeptGroup2->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            // dd($semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup);

            // Calculate the sum of total_achievement_weight for each semester group
            $sumGroupSemester1 = $semester1Group->map(function ($group) {
                return $group->sum('total_achievement_weight');
            });
            $sumGroupSemester2 = $semester2Group->map(function ($group) {
                return $group->sum('total_achievement_weight');
            });

            $sumSemester1Dept = $semester1DeptGroup->sum('total_achievement_weight');
            $sumSemester2Dept = $semester2DeptGroup->sum('total_achievement_weight');

            // dd($employees, $semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup, $sumGroupSemester1, $sumGroupSemester2, $sumSemester1Dept, $sumSemester2Dept,);

            // $total = ($sumGroupSemester1 + $sumGroupSemester2) * 0.7;
            // $totalDept = ($sumSemester1Dept + $sumSemester2Dept) * 0.3;
            // $totalAll = $total + $totalDept;


            return view('report.summary-department-report', [
                'title' => 'Report',
                'desc' => 'Department Report',
                'allDept' => $allDept,
                'allOccupation' => $allStatus,
                'employees' => $employees,
                'semester1Group' => $semester1Group,
                'semester2Group' => $semester2Group,
                'semester1DeptGroup' => $semester1DeptGroup,
                'semester2DeptGroup' => $semester2DeptGroup,
                'sumGroupSemester1' => $sumGroupSemester1,
                'sumGroupSemester2' => $sumGroupSemester2,
                'sumGroupSemester1Dept' => $sumSemester1Dept,
                'sumGroupSemester2Dept' => $sumSemester2Dept,
                // 'total' => $total,
                // 'totalDept' => $totalDept,
                // 'totalAll' => $totalAll,
            ]);
        } elseif ($yearToShow && $status) {
            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id', 'department_id')
                ->where('employees.status', '=', $status)
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);
            // dd($employees);

            $semester1Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '1')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '2')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester1ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '1')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '2')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $actualsGroup1 = $semester1Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsGroup2 = $semester2Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsDeptGroup1 = $semester1ActualsDept->groupBy('kpi_code');
            $actualsDeptGroup2 = $semester2ActualsDept->groupBy('kpi_code');

            $semester1Group = $actualsGroup1->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester2Group = $actualsGroup2->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester1DeptGroup = $actualsDeptGroup1->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            $semester2DeptGroup = $actualsDeptGroup2->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            // dd($semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup);

            // Calculate the sum of total_achievement_weight for each semester group
            $sumSemester1 = $semester1Group->flatten(1)->sum('total_achievement_weight');
            $sumSemester2 = $semester2Group->flatten(1)->sum('total_achievement_weight');
            $sumSemester1Dept = $semester1DeptGroup->sum('total_achievement_weight');
            $sumSemester2Dept = $semester2DeptGroup->sum('total_achievement_weight');

            // dd($employees, $semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup, $sumSemester1, $sumSemester2, $sumSemester1Dept, $sumSemester2Dept);

            return view('report.summary-department-report', [
                'title' => 'Report',
                'desc' => 'Department Report',
                'allDept' => $allDept,
                'allOccupation' => $allStatus,
                'semester1Group' => $semester1Group,
                'employees' => $employees,
                'semester2Group' => $semester2Group,
                'semester1DeptGroup' => $semester1DeptGroup,
                'semester2DeptGroup' => $semester2DeptGroup,
                'sumSemester1' => $sumSemester1,
                'sumSemester2' => $sumSemester2,
                'sumSemester1Dept' => $sumSemester1Dept,
                'sumSemester2Dept' => $sumSemester2Dept,
            ]);
        } elseif ($yearToShow) {

            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id', 'department_id')
                ->paginate(18)
                ->appends(['year' => $yearToShow, 'department' => $department, 'occupation' => $status]);
            // dd($employees);

            $semester1Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '1')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2Actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('actuals.*', 'employees.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('actuals.semester', '=', '2')
                ->whereYear('actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester1ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '1')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $semester2ActualsDept = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
                ->select('department_actuals.*', 'departments.name as department_name', 'departments.id as department_id')
                ->where('department_actuals.semester', '=', '2')
                ->whereYear('department_actuals.date', '=', $yearToShow)
                ->where('departments.id', '=', $department)
                ->get();

            $actualsGroup1 = $semester1Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsGroup2 = $semester2Actuals->groupBy(['employee_id', 'kpi_code']);
            $actualsDeptGroup1 = $semester1ActualsDept->groupBy('kpi_code');
            $actualsDeptGroup2 = $semester2ActualsDept->groupBy('kpi_code');

            $semester1Group = $actualsGroup1->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester2Group = $actualsGroup2->map(function ($group) {
                return $group->map(function ($subGroup) {
                    $totalTarget = $subGroup->sum(function ($item) {
                        return (float) $item->target;
                    });

                    $totalActual = $subGroup->sum(function ($item) {
                        return (float) $item->actual;
                    });

                    $firstItem = $subGroup->first();
                    $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                    $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                    $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                    $totalAchievementWeight = $convertedCalc * $weight / 100;

                    return [
                        'total_target' => $totalTarget,
                        'total_actual' => $totalActual,
                        'weight' => $weight,
                        'percentageCalc' => $convertedCalc,
                        'total_achievement_weight' => $totalAchievementWeight,
                    ];
                });
            });

            $semester1DeptGroup = $actualsDeptGroup1->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            $semester2DeptGroup = $actualsDeptGroup2->map(function ($group) {
                $totalTarget = $group->sum(function ($item) {
                    return (float) $item->target;
                });

                $totalActual = $group->sum(function ($item) {
                    return (float) $item->actual;
                });

                $firstItem = $group->first();
                $percentageCalc = $this->calculation($totalTarget, $totalTarget, $totalActual, $firstItem->trend);

                $convertedCalc = floatval(str_replace('%', '', $percentageCalc));

                $weight = floatval($firstItem->kpi_weighting); // Ambil bobot dari item pertama dalam grup
                $totalAchievementWeight = $convertedCalc * $weight / 100;

                return [
                    'total_target' => $totalTarget,
                    'total_actual' => $totalActual,
                    'weight' => $weight,
                    'percentageCalc' => $convertedCalc,
                    'total_achievement_weight' => $totalAchievementWeight,
                ];
            });

            // dd($semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup);

            // Calculate the sum of total_achievement_weight for each semester group
            $sumSemester1 = $semester1Group->flatten(1)->sum('total_achievement_weight');
            $sumSemester2 = $semester2Group->flatten(1)->sum('total_achievement_weight');
            $sumSemester1Dept = $semester1DeptGroup->sum('total_achievement_weight');
            $sumSemester2Dept = $semester2DeptGroup->sum('total_achievement_weight');

            // dd($employees, $semester1Group, $semester2Group, $semester1DeptGroup, $semester2DeptGroup, $sumSemester1, $sumSemester2, $sumSemester1Dept, $sumSemester2Dept);

            return view('report.summary-department-report', [
                'title' => 'Report',
                'desc' => 'Department Report',
                'allDept' => $allDept,
                'allOccupation' => $allStatus,
                'employees' => $employees,
                'semester1Group' => $semester1Group,
                'semester2Group' => $semester2Group,
                'semester1DeptGroup' => $semester1DeptGroup,
                'semester2DeptGroup' => $semester2DeptGroup,
                'sumSemester1' => $sumSemester1,
                'sumSemester2' => $sumSemester2,
                'sumSemester1Dept' => $sumSemester1Dept,
                'sumSemester2Dept' => $sumSemester2Dept,
            ]);
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

    public function indexDeptTargetReport(Request $request)
    {
        $year = $request->query('year');
        $targets = DB::table('department_targets')->select('department_targets.indicator',)->whereYear('department_targets.date', '=', $year)
            ->groupBy('department_targets.indicator')
            // ->orderBy('indicator', 'desc')
            ->get();

        // dd($targets);

        return view('report.list-kpi-department-report', ['title' => 'Report', 'desc' => 'KPI Dept Report', 'targets' => $targets]);
    }

    public function departmentTargetReport(Request $request)
    {
        $year = $request->query('year');
        $item = $request->query('item');

        $actuals = DB::table('department_actuals')->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
            ->select('department_actuals.*', 'departments.name as department')
            ->whereYear('department_actuals.date', '=', $year)
            ->where('kpi_item', '=', $item)
            ->get();

        $targets = DB::table('department_targets')->leftJoin('departments', 'departments.id', '=', 'department_targets.department_id')
            ->select('department_targets.*', 'departments.name as department')
            ->whereYear('department_targets.date', '=', $year)
            ->where('indicator', '=', $item)->get();

        // dd($targets);


        // dd($actuals);

        return view('report.target-kpi-department-report', ['title' => 'Department Target Report', 'desc' => 'Department Target Report', 'actuals' => $actuals, 'targets' => $targets]);
    }
}
