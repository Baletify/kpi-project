<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Models\Actual;
use App\Models\Department;
use App\Models\DepartmentActual;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $department = $request->query('department');
        if ($department) {
            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->get();

            return view('report.list-employee-report', ['title' => 'Report', 'desc' => 'Employee List', 'departments' => $departments]);
        } else {
            abort(404, 'No actuals found for the given year and semester');
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
                ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'actuals.kpi_item', 'actuals.kpi_code as kpi_code', 'actuals.kpi_weighting', 'actuals.kpi_percentage as achievement', 'employees.name as name', 'departments.name as department', 'employees.occupation as occupation', 'employees.nik as nik', 'actuals.semester as semester', 'actuals.date as year', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.record_file', 'actuals.id as actual_id', 'actuals.status as status')
                ->where('actuals.employee_id', $id)
                ->where('actuals.semester', $semester)
                ->where(DB::raw('YEAR(actuals.date)'), $year)
                ->orderBy(DB::raw('MONTH(actuals.date)'))
                ->get();



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

                $totalPercentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;


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

            return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee, 'actuals' => $actuals, 'targets' => $targets, 'totals' => $totals]);
        } else {

            abort(404, 'No actuals found for the given year and semester');
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
                ->select('department_actuals.date as date', 'department_actuals.department_id as department_id', 'department_actuals.kpi_item', 'department_actuals.kpi_code as kpi_code', 'department_actuals.kpi_weighting', 'department_actuals.kpi_percentage as achievement', 'department_actuals.semester as semester', DB::raw('YEAR(department_actuals.date) as year'), 'department_actuals.target', 'department_actuals.actual', 'department_actuals.kpi_percentage', 'department_actuals.record_file', 'department_actuals.id as department_actual_id', 'department_actuals.status as status', 'departments.name as department')
                ->where('department_actuals.department_id', $id)
                ->where('department_actuals.semester', $semester)
                ->where(DB::raw('YEAR(department_actuals.date)'), $year)
                ->orderBy(DB::raw('MONTH(department_actuals.date)'))->get();

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
                $totalPercentage = $totalTarget > 0 ? ($totalActual / $totalTarget) * 100 : 0;


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

            return view('report.department-report', ['title' => 'Report', 'desc' => 'Summary KPI Dept', 'actuals' => $actuals, 'targets' => $targets, 'totals' => $totals]);
        }
    }

    public function summaryDept(Request $request)
    {
        $department = $request->query('department');
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $yearToShow = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;


        if ($department && $yearToShow) {

            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select('departments.name as dept', 'employees.name as name', 'employees.nik', 'employees.occupation', 'employees.id as employee_id')
                ->where('employees.department_id', $department)
                ->get();

            $actuals = DB::table('actuals')->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where('departments.id', '=', $department)
                ->where(DB::raw('YEAR(actuals.date)'), '=', $yearToShow)
                ->get();


            $groupedData = $actuals->groupBy(['employee_id', 'semester']);
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

            // Hitung total bobot pencapaian per karyawan untuk semester 1 dan semester 2
            $employeeTotals = [];
            foreach ($employees as $employee) {
                $semester1Weight = floatval($totals[$employee->employee_id][1]['total_achievement_weight'] ?? 0);
                $semester2Weight = floatval($totals[$employee->employee_id][2]['total_achievement_weight'] ?? 0);
                $employeeTotals[$employee->employee_id] = [
                    'semester_1' => $semester1Weight,
                    'semester_2' => $semester2Weight,
                    'total' => $semester1Weight + $semester2Weight,
                ];
            }


            return view('report.summary-department-report', ['title' => 'Report', 'desc' => 'Department Report', 'employees' => $employees, 'employeeTotals' => $employeeTotals,]);
        } else {
            return abort(404, 'No actuals found for the given year and semester');
        }
    }


    public function showFile(Request $request)
    {
        $month = $request->query('month');
        $actualId = $request->query('actual_id');

        $pdfUrls = Actual::whereMonth('date', $month)
            ->get(['id', 'record_file', 'kpi_code', 'kpi_item', 'status'])
            ->toArray();

        return response()->json($pdfUrls);
    }

    public function showFileDept(Request $request)
    {
        $month = $request->query('month');

        $pdfUrls = DepartmentActual::whereMonth('date', $month)->pluck('record_file')->toArray();

        return response()->json($pdfUrls);
    }
}
