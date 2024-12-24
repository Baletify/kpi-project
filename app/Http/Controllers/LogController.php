<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $semester = ($currentMonth < 7) ? '1' : '2';
        $year = $request->query('year');

        if ($semester === '1') {
            $months = range(1, 6); // January to June
        } else {
            $months = range(7, 12); // July to December
        }

        $departments = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('departments.code as department_code', 'actuals.created_at', 'departments.id as department_id')
            ->whereIn('actuals.id', function ($query) use ($months) {
                $query->select(DB::raw('MAX(actuals.id)'))
                    ->from('actuals')
                    ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                    ->join('departments', 'employees.department_id', '=', 'departments.id')
                    ->whereIn(DB::raw('MONTH(actuals.created_at)'), $months)
                    ->groupBy('departments.code', DB::raw('MONTH(actuals.created_at), departments.id'));
            })
            ->whereIn(DB::raw('MONTH(actuals.created_at)'), $months)
            ->orderBy('actuals.created_at', 'desc')
            ->get()
            ->groupBy('department_code')
            ->map(function ($items) {
                return collect($items);
            });

        $targetCounts = DB::table('targets')
            ->leftJoin('employees', 'targets.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->where(DB::raw('YEAR(targets.date)'), $year)
            ->select('departments.code as code', DB::raw('count(targets.id) as total'))
            ->groupBy('departments.code')
            ->get();

        $targetCountsDept = DB::table('department_targets')
            ->leftJoin('departments', 'department_targets.department_id', '=', 'departments.id')
            ->where(DB::raw('YEAR(department_targets.date)'), $year)
            ->select('departments.code as code', DB::raw('count(department_targets.id) as total'))
            ->groupBy('departments.code')
            ->get();




        $targetUnitCounts1 = DB::table('target_units')
            ->leftJoin('targets', 'target_units.id', '=', 'targets.target_unit_id')
            ->leftJoin('employees', 'targets.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')

            ->whereYear('targets.date', $year)
            // ->whereNotNull('target_units.id')
            ->select(
                'departments.code as department_code',
                DB::raw('count(target_units.target_1) as total_1'),
                DB::raw('count(target_units.target_2) as total_2'),
                DB::raw('count(target_units.target_3) as total_3'),
                DB::raw('count(target_units.target_4) as total_4'),
                DB::raw('count(target_units.target_5) as total_5'),
                DB::raw('count(target_units.target_6) as total_6'),
            )
            ->groupBy('departments.code')
            ->get();


        $targetUnitCounts2 = DB::table('target_units')
            ->leftJoin('targets', 'target_units.id', '=', 'targets.target_unit_id')
            ->leftJoin('employees', 'targets.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->whereYear('targets.date', $year)
            ->select(
                'departments.code as department_code',
                DB::raw('count(target_units.target_7) as total_7'),
                DB::raw('count(target_units.target_8) as total_8'),
                DB::raw('count(target_units.target_9) as total_9'),
                DB::raw('count(target_units.target_10) as total_10'),
                DB::raw('count(target_units.target_11) as total_11'),
                DB::raw('count(target_units.target_12) as total_12')
            )
            ->groupBy('departments.code')
            ->get();

        $targetUnitCountsDept1 = DB::table('target_units')
            ->leftJoin('department_targets', 'target_units.id', '=', 'department_targets.target_unit_id')
            ->leftJoin('departments', 'department_targets.department_id', '=', 'departments.id')

            ->whereYear('department_targets.date', $year)
            // ->whereNotNull('target_units.id')
            ->select(
                'departments.code as department_code',
                DB::raw('count(target_units.target_1) as total_1'),
                DB::raw('count(target_units.target_2) as total_2'),
                DB::raw('count(target_units.target_3) as total_3'),
                DB::raw('count(target_units.target_4) as total_4'),
                DB::raw('count(target_units.target_5) as total_5'),
                DB::raw('count(target_units.target_6) as total_6'),
            )
            ->groupBy('departments.code')
            ->get();

        $targetUnitCountsDept2 = DB::table('target_units')
            ->leftJoin('department_targets', 'target_units.id', '=', 'department_targets.target_unit_id')
            ->leftJoin('departments', 'department_targets.department_id', '=', 'departments.id')
            ->whereYear('department_targets.date', $year)
            ->select(
                'departments.code as department_code',
                DB::raw('count(target_units.target_7) as total_7'),
                DB::raw('count(target_units.target_8) as total_8'),
                DB::raw('count(target_units.target_9) as total_9'),
                DB::raw('count(target_units.target_10) as total_10'),
                DB::raw('count(target_units.target_11) as total_11'),
                DB::raw('count(target_units.target_12) as total_12')
            )
            ->groupBy('departments.code')
            ->get();


        $actualCounts = DB::table('actuals')
            ->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->select('departments.code as department_code', DB::raw('MONTH(actuals.date) as month'), DB::raw('count(actuals.status) as total'))
            ->where('actuals.status', 'Approved')
            ->where(DB::raw('YEAR(actuals.date)'), $year)
            ->whereIn(DB::raw('MONTH(actuals.date)'), $months)
            ->groupBy('departments.code', DB::raw('MONTH(actuals.date)'))
            ->get()
            ->map(function ($item) {
                return (array) $item;
            });

        $actualCountsDept = DB::table('department_actuals')
            ->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
            ->select('departments.code as department_code', DB::raw('MONTH(department_actuals.date) as month'), DB::raw('count(department_actuals.status) as total'))
            ->where('department_actuals.status', 'Approved')
            ->where(DB::raw('YEAR(department_actuals.date)'), $year)
            ->whereIn(DB::raw('MONTH(department_actuals.date)'), $months)
            ->groupBy('departments.code', DB::raw('MONTH(department_actuals.date)'))
            ->get()
            ->map(function ($item) {
                return (array) $item;
            });


        return view('logs/log-check', [
            'title' => 'Log Input',
            'desc' => 'History',
            'departments' => $departments,
            'months' => $months,
            'semester' => $semester,
            'targetCounts' => $targetCounts,
            'targetCountsDept' => $targetCountsDept,
            'actualCounts' => $actualCounts,
            'actualCountsDept' => $actualCountsDept,
            'targetUnitCounts1' => $targetUnitCounts1,
            'targetUnitCounts2' => $targetUnitCounts2,
            'targetUnitCountsDept1' => $targetUnitCountsDept1,
            'targetUnitCountsDept2' => $targetUnitCountsDept2,


        ]);
    }

    public function indexInput(Request $request)
    {

        $department = $request->query('department');
        $month = $request->query('month');
        $year = $request->query('year');


        if ($department && $month && $year) {
            $actualFilledCheck = DB::table('actuals')
                ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('actuals.status', '=', 'Filled')
                ->whereMonth('actuals.date', $month)
                ->whereYear('actuals.date', $year)
                ->select('actuals.id', 'actuals.kpi_code', 'actuals.kpi_item', 'actuals.kpi_unit', 'actuals.review_period', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.kpi_calculation', 'actuals.supporting_document', 'actuals.comment', 'actuals.record_file', 'actuals.department_name', 'actuals.kpi_weighting', 'actuals.date', 'actuals.semester', 'actuals.trend', 'actuals.status', 'actuals.detail', 'actuals.input_by', 'actuals.input_at', 'actuals.checked_by', 'actuals.checked_at', 'actuals.approved_by', 'actuals.approved_at', 'actuals.employee_id', 'actuals.created_at', 'actuals.updated_at', 'departments.id as department_id')
                ->get();
            $actualCheckedCheck = DB::table('actuals')
                ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('actuals.status', '=', 'Checked')
                ->whereMonth('actuals.date', $month)
                ->whereYear('actuals.date', $year)
                ->select('actuals.id', 'actuals.kpi_code', 'actuals.kpi_item', 'actuals.kpi_unit', 'actuals.review_period', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.kpi_calculation', 'actuals.supporting_document', 'actuals.comment', 'actuals.record_file', 'actuals.department_name', 'actuals.kpi_weighting', 'actuals.date', 'actuals.semester', 'actuals.trend', 'actuals.status', 'actuals.detail', 'actuals.input_by', 'actuals.input_at', 'actuals.checked_by', 'actuals.checked_at', 'actuals.approved_by', 'actuals.approved_at', 'actuals.employee_id', 'actuals.created_at', 'actuals.updated_at', 'departments.id as department_id')
                ->get();

            $actualApproved = DB::table('actuals')
                ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('actuals.status', '=', 'Approved')
                ->whereMonth('actuals.date', $month)
                ->whereYear('actuals.date', $year)
                ->select('actuals.id', 'actuals.kpi_code', 'actuals.kpi_item', 'actuals.kpi_unit', 'actuals.review_period', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.kpi_calculation', 'actuals.supporting_document', 'actuals.comment', 'actuals.record_file', 'actuals.department_name', 'actuals.kpi_weighting', 'actuals.date', 'actuals.semester', 'actuals.trend', 'actuals.status', 'actuals.detail', 'actuals.input_by', 'actuals.input_at', 'actuals.checked_by', 'actuals.checked_at', 'actuals.approved_by', 'actuals.approved_at', 'actuals.employee_id', 'actuals.created_at', 'actuals.updated_at', 'departments.id as department_id')
                ->orderBy('actuals.approved_at', 'desc')->get();

            $actualChecked = DB::table('actuals')
                ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('actuals.status', '=', 'Checked')
                ->whereMonth('actuals.date', $month)
                ->whereYear('actuals.date', $year)
                ->select('actuals.id', 'actuals.kpi_code', 'actuals.kpi_item', 'actuals.kpi_unit', 'actuals.review_period', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.kpi_calculation', 'actuals.supporting_document', 'actuals.comment', 'actuals.record_file', 'actuals.department_name', 'actuals.kpi_weighting', 'actuals.date', 'actuals.semester', 'actuals.trend', 'actuals.status', 'actuals.detail', 'actuals.input_by', 'actuals.input_at', 'actuals.checked_by', 'actuals.checked_at', 'actuals.approved_by', 'actuals.approved_at', 'actuals.employee_id', 'actuals.created_at', 'actuals.updated_at', 'departments.id as department_id')
                ->orderBy('actuals.checked_at', 'desc')->get();

            $actualFilled = DB::table('actuals')
                ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->whereIn('actuals.status', ['Filled', 'Checked', 'Approved'])
                ->whereMonth('actuals.date', $month)
                ->whereYear('actuals.date', $year)
                ->select('actuals.id', 'actuals.kpi_code', 'actuals.kpi_item', 'actuals.kpi_unit', 'actuals.review_period', 'actuals.target', 'actuals.actual', 'actuals.kpi_percentage', 'actuals.kpi_calculation', 'actuals.supporting_document', 'actuals.comment', 'actuals.record_file', 'actuals.department_name', 'actuals.kpi_weighting', 'actuals.date', 'actuals.semester', 'actuals.trend', 'actuals.status', 'actuals.detail', 'actuals.input_by', 'actuals.input_at', 'actuals.checked_by', 'actuals.checked_at', 'actuals.approved_by', 'actuals.approved_at', 'actuals.employee_id', 'actuals.created_at', 'actuals.updated_at', 'departments.id as department_id')
                ->orderBy('actuals.approved_at', 'desc')->get();

            $actualFilledCount = DB::table('actuals')
                ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('actuals.input_at', '!=', '')
                ->whereMonth('actuals.date', $month)
                ->whereYear('actuals.date', $year)
                ->select(DB::raw('count(actuals.id) as total_filled'), 'departments.id as department_id')
                ->orderBy('actuals.input_at', 'desc')
                ->groupBy('departments.id')
                ->first();

            $actualFilledCountDept = DB::table('department_actuals')
                ->join('departments', 'department_actuals.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('department_actuals.input_at', '!=', '')
                ->whereMonth('department_actuals.date', $month)
                ->whereYear('department_actuals.date', $year)
                ->select(DB::raw('count(department_actuals.id) as total_filled'), 'departments.id as department_id')
                ->orderBy('department_actuals.input_at', 'desc')
                ->groupBy('departments.id')
                ->first();

            $actualCheckedCount = DB::table('actuals')
                ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('actuals.checked_at', '!=', '')
                ->whereMonth('actuals.date', $month)
                ->whereYear('actuals.date', $year)
                ->select(DB::raw('count(actuals.id) as total_checked'), 'departments.id as department_id')
                ->orderBy('actuals.input_at', 'desc')
                ->groupBy('departments.id')
                ->first();

            $actualCheckedCountDept = DB::table('department_actuals')
                ->join('departments', 'department_actuals.department_id', '=', 'departments.id')
                ->where('departments.id', $department)
                ->where('department_actuals.checked_at', '!=', '')
                ->whereMonth('department_actuals.date', $month)
                ->whereYear('department_actuals.date', $year)
                ->select(DB::raw('count(department_actuals.id) as total_checked'), 'departments.id as department_id')
                ->orderBy('department_actuals.input_at', 'desc')
                ->groupBy('departments.id')
                ->first();

            $targetUnitCountAll = DB::table('target_units')
                ->leftJoin('targets', 'target_units.id', '=', 'targets.target_unit_id')
                ->leftJoin('employees', 'targets.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
                ->where('departments.id', '=', $department)
                ->whereYear('targets.date', $year)
                // ->whereNotNull('target_units.id')
                ->select(
                    'departments.id as department_id',
                    DB::raw('count(target_units.target_1) as total_1'),
                    DB::raw('count(target_units.target_2) as total_2'),
                    DB::raw('count(target_units.target_3) as total_3'),
                    DB::raw('count(target_units.target_4) as total_4'),
                    DB::raw('count(target_units.target_5) as total_5'),
                    DB::raw('count(target_units.target_6) as total_6'),
                    DB::raw('count(target_units.target_7) as total_7'),
                    DB::raw('count(target_units.target_8) as total_8'),
                    DB::raw('count(target_units.target_9) as total_9'),
                    DB::raw('count(target_units.target_10) as total_10'),
                    DB::raw('count(target_units.target_11) as total_11'),
                    DB::raw('count(target_units.target_12) as total_12'),
                )
                ->groupBy('departments.id')
                ->first();

            $targetUnitCountAllDept = DB::table('target_units')
                ->leftJoin('department_targets', 'target_units.id', '=', 'department_targets.target_unit_id')
                ->leftJoin('departments', 'department_targets.department_id', '=', 'departments.id')
                ->where('departments.id', '=', $department)
                ->whereYear('department_targets.date', $year)
                // ->whereNotNull('target_units.id')
                ->select(
                    'departments.id as department_id',
                    DB::raw('count(target_units.target_1) as total_1'),
                    DB::raw('count(target_units.target_2) as total_2'),
                    DB::raw('count(target_units.target_3) as total_3'),
                    DB::raw('count(target_units.target_4) as total_4'),
                    DB::raw('count(target_units.target_5) as total_5'),
                    DB::raw('count(target_units.target_6) as total_6'),
                    DB::raw('count(target_units.target_7) as total_7'),
                    DB::raw('count(target_units.target_8) as total_8'),
                    DB::raw('count(target_units.target_9) as total_9'),
                    DB::raw('count(target_units.target_10) as total_10'),
                    DB::raw('count(target_units.target_11) as total_11'),
                    DB::raw('count(target_units.target_12) as total_12'),
                )
                ->groupBy('departments.id')
                ->first();
            // dd($actualFilledCount, $targetUnitCountAll, $actualFilledCountDept, $targetUnitCountAllDept);
            // dd($actualFilledCountDept, $targetUnitCountAllDept);


            $departments = DB::table('departments')->where('departments.id', '=', $department)->get();
            $countEmployees = DB::table('employees')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->select(DB::raw('count(employees.id) as total_employee'), 'departments.id as department_id',)->where('departments.id', $department)->groupBy('departments.id')->get();

            // dd($actualFilledCheck, $actualCheckedCheck, $actualApproved, $actualChecked, $countEmployees);
            return view('logs/log-input', [
                'title' => 'Log Input',
                'desc' => 'History',
                'actualFilledCheck' => $actualFilledCheck,
                'actualCheckedCheck' => $actualCheckedCheck,
                'actualApproved' => $actualApproved,
                'actualFilled' => $actualFilled,
                'actualChecked' => $actualChecked,
                'departments' => $departments,
                'countEmployees' => $countEmployees,
                'actualFilledCount' => $actualFilledCount,
                'actualFilledCountDept' => $actualFilledCountDept,
                'actualCheckedCount' => $actualCheckedCount,
                'actualCheckedCountDept' => $actualCheckedCountDept,
                'targetUnitCountAll' => $targetUnitCountAll,
                'targetUnitCountAllDept' => $targetUnitCountAllDept,
            ]);
        } else if ($department) {
            return view('logs/log-input', [
                'title' => 'Log Input',
                'desc' => 'History',
            ]);
        }
    }

    public function individual(Request $request)
    {

        $department = $request->query('department');
        $month = $request->query('month');
        $year = $request->query('year');
        $allDept = Department::all();

        if ($department && $month && $year) {

            $employees = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->select('employees.*', 'departments.name as department')
                ->where('employees.department_id',  '=', $department)->get();


            $employeesInput = DB::table('actuals')
                ->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->whereMonth('actuals.date', '=', $month)
                ->whereYear('actuals.date', '=', $year)
                ->where('departments.id', '=', $department)
                ->select('employees.id', 'employees.name', 'departments.name as department', DB::raw('MAX(actuals.input_at) as latest_input_at'), DB::raw('MAX(actuals.approved_at) as latest_approved_at'))
                ->groupBy('employees.id', 'employees.name', 'departments.name')
                ->orderBy('latest_input_at', 'desc')
                ->get();



            return view('logs/log-input-individual', [
                'title' => 'Log Input Individual',
                'desc' => 'History',
                'employeesInput' => $employeesInput,
                'employees' => $employees,
                'department' => $allDept,

            ]);
        } else if ($department) {
            return view('logs/log-input-individual', [
                'title' => 'Log Input',
                'desc' => 'History',
            ]);
        }
    }
}
