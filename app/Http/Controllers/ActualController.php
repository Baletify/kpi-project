<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Actual;
use App\Models\ActualDepartment;
use App\Models\Department;
use App\Models\DepartmentActual;

class ActualController extends Controller
{
    public function show(Request $request)
    {
        $employeeID = $request->query('employee');
        $employee = Employee::find($employeeID);
        $year = $request->query('year');


        // Ambil data targets
        $targets = DB::table('targets')
            ->select('id', 'code', 'indicator', 'period', 'employee_id')
            ->where('employee_id', $employeeID)
            ->where(DB::raw('YEAR(date)'), '=', $year)
            ->get();

        // Ambil data actuals
        $actuals = DB::table('actuals')
            ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
            ->leftJoin('targets', 'actuals.kpi_code', '=', 'targets.code')
            ->select('actuals.kpi_code as kpi_code', 'targets.code as code', 'actuals.date as actual_date', 'targets.date as target_date', 'targets.indicator as indicator')
            // ->where(DB::raw('MONTH(actuals.date)'), '<=', $now->month)
            ->where('actuals.employee_id', $employeeID)
            ->where(DB::raw('YEAR(actuals.date)'), '=', $year)
            ->get();

        // dd($actuals);
        return view('actual.input-actual-employee', [
            'title' => 'Input Data Realisasi',
            'desc' => 'Employee Achievement',
            'employee' => $employee,
            'targets' => $targets,
            'actuals' => $actuals
        ]);
    }

    public function showDept(Request $request)
    {
        $departmentID = $request->query('department');
        $department = Department::find($departmentID);
        $year = $request->query('year');


        // Ambil data targets
        $targets = DB::table('department_targets')
            ->where('department_targets.department_id', '=', $departmentID)
            ->where(DB::raw('YEAR(department_targets.date)'), '=', $year)
            ->get();

        // Ambil data actuals
        $actuals = DB::table('department_actuals')
            ->leftJoin('departments', 'departments.id', '=', 'department_actuals.department_id')
            ->leftJoin('department_targets', 'department_actuals.kpi_code', '=', 'department_targets.code')
            ->select('department_actuals.kpi_code as kpi_code', 'department_targets.code as code', 'department_actuals.date as actual_date', 'department_targets.date as target_date', 'department_targets.indicator as indicator')
            // ->where(DB::raw('MONTH(actuals.date)'), '<=', $now->month)
            ->where('department_actuals.department_id', '=', $departmentID)
            ->get();

        // dd($actuals);
        return view('actual.input-actual-department-details', [
            'title' => 'Input Data Realisasi',
            'desc' => 'Department Achievement',
            'departments' => $department,
            'targets' => $targets,
            'actuals' => $actuals
        ]);
    }

    public function department(Request $request)
    {
        $department = $request->query('department');

        if ($department) {
            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->get();

            return view('actual.input-actual-department', [
                'title' => 'Input Data Realisasi',
                'desc' => 'Achievement',
                'departments' => $departments
            ]);
        } else {
            return view('components/404-page');
        }
    }

    public function edit($id, Request $request)
    {

        $year = $request->query('year');
        $employee = Employee::find($id);
        $targets = DB::table('targets')->leftJoin('target_units', 'target_units.id', '=', 'targets.target_unit_id')
            ->leftJoin('employees', 'employees.id', '=', 'targets.employee_id')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->where('targets.id', '=', $id)
            ->where(DB::raw('YEAR(targets.date)'), $year)
            ->select('targets.id', 'targets.employee_id', 'targets.code', 'targets.indicator', 'targets.calculation', 'targets.period', 'targets.unit', 'targets.supporting_document', 'targets.weighting', 'targets.detail', 'targets.trend', 'target_units.id as target_unit_id', 'employees.nik as nik', 'employees.occupation as occupation', 'employees.name as employee', 'departments.name as department', 'target_1 as target_unit_1', 'target_2 as target_unit_2', 'target_3 as target_unit_3', 'target_4 as target_unit_4', 'target_5 as target_unit_5', 'target_6 as target_unit_6', 'target_7 as target_unit_7', 'target_8 as target_unit_8', 'target_9 as target_unit_9', 'target_10 as target_unit_10', 'target_11 as target_unit_11', 'target_12 as target_unit_12')
            ->get();

        // dd($targets->toBase());

        // dd($targets->toSql());
        return view('actual.input-actual-achievement', [
            'title' => 'Input Data Realisasi',
            'desc' => 'Achievement',
            'employees' => $employee,
            'targets' => $targets
        ]);
    }

    public function editDept($id, Request $request)
    {
        $department = Department::find($id);
        $year = $request->query('year');

        $targets = DB::table('department_targets')
            ->leftJoin('departments', 'departments.id', '=', 'department_targets.department_id')
            ->leftJoin('target_units', 'department_targets.target_unit_id', '=', 'target_units.id')
            ->select('department_targets.id', 'department_targets.department_id', 'department_targets.trend', 'department_targets.target_unit_id', 'departments.name as department', 'department_targets.code', 'department_targets.indicator', 'department_targets.calculation', 'department_targets.supporting_document', 'department_targets.period', 'department_targets.date', 'department_targets.weighting', 'department_targets.unit', 'department_targets.detail', 'target_units.target_1 as target_unit_1', 'target_units.target_2 as target_unit_2', 'target_units.target_3 as target_unit_3', 'target_units.target_4 as target_unit_4', 'target_units.target_5 as target_unit_5', 'target_units.target_6 as target_unit_6', 'target_units.target_7 as target_unit_7', 'target_units.target_8 as target_unit_8', 'target_units.target_9 as target_unit_9', 'target_units.target_10 as target_unit_10', 'target_units.target_11 as target_unit_11', 'target_units.target_12 as target_unit_12')
            ->where('department_targets.id', $id)
            ->where(DB::raw('YEAR(department_targets.date)'), $year)
            ->get();



        return view('actual.input-actual-department-achievement', [
            'title' => 'Input Data Realisasi',
            'desc' => 'Department Achievement',
            'department' => $department,
            'targets' => $targets
        ]);
    }

    public function storeDept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'actual' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $date = Carbon::createFromDate($request->year, $request->date, 1)->startOfMonth();

        if ($request->hasFile('record_file')) {
            $recordFile = $request->file('record_file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('record_files'), $recordFileName);;
        }

        $semester = '';

        if ($request->date > 6 && $request->date <= 12) {
            $semester = '2';
        } else {
            $semester = '1';
        }

        $actual = '';
        $kpi_percentage = '';
        if ($request->record_file == null) {
            $actual = '0';
            $kpi_percentage = '0';
        } else {
            $actual = $request->actual;
            $kpi_percentage = $request->achievement;
        }


        $searchConditions = [
            'kpi_code' => $request->kpi_code,
            'date' => $date,
            'department_id' => $request->department_id,
        ];

        $dataToUpdateOrCreate = [
            'kpi_item' => $request->kpi_item,
            'kpi_unit' => $request->kpi_unit,
            'review_period' => $request->review_period,
            'target' => $request->target,
            'actual' => $actual,
            'kpi_percentage' => $kpi_percentage,
            'kpi_calculation' => $request->kpi_calculation,
            'supporting_document' => $request->supporting_document,
            'comment' => $request->comment,
            'record_file' => isset($recordFileName) ? $recordFileName : null,
            'department_name' => $request->department_name,
            'kpi_weighting' => $request->kpi_weighting,
            'trend' => $request->trend,
            'status' => $request->status,
            'semester' => $semester,
            'detail' => $request->detail,
            'input_by' => $request->input_by,
            'input_at' => now(),
        ];

        DepartmentActual::updateOrCreate($searchConditions, $dataToUpdateOrCreate);

        return redirect()->to('actual/input-actual-department-details?department=' . $request->input('department_id') . '&year=' . $request->input('year'));
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'actual' => 'required',
        ]);
        if ($validator->fails()) {
            flash()->error('Please fill all the required field');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }



        $date = Carbon::createFromDate($request->year, $request->date, 1)->startOfMonth();

        if ($request->hasFile('record_file')) {
            $recordFile = $request->file('record_file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('record_files'), $recordFileName);;
        }

        $currentMonth = now()->month;
        $currentYear = now()->year;
        $yearToShow = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

        $semester = '';

        if ($request->date > 6 && $request->date <= 12) {
            $semester = '2';
        } else {
            $semester = '1';
        }

        $actual = '';
        $kpi_percentage = '';
        if ($request->record_file == null) {
            $actual = '0';
            $kpi_percentage = '0';
        } else {
            $actual = $request->actual;
            $kpi_percentage = $request->achievement;
        }

        $searchConditions = [
            'kpi_code' => $request->kpi_code,
            'date' => $date,
            'employee_id' => $request->employee_id,
        ];

        $dataToUpdateOrCreate = [
            'kpi_item' => $request->kpi_item,
            'kpi_unit' => $request->kpi_unit,
            'review_period' => $request->review_period,
            'target' => $request->target,
            'actual' => $actual,
            'kpi_percentage' => $kpi_percentage,
            'kpi_calculation' => $request->kpi_calculation,
            'supporting_document' => $request->supporting_document,
            'comment' => $request->comment,
            'record_file' => isset($recordFileName) ? $recordFileName : null,
            'department_name' => $request->department_name,
            'kpi_weighting' => $request->kpi_weighting,
            'trend' => $request->trend,
            'status' => $request->status,
            'semester' => $semester,
            'detail' => $request->detail,
            'input_by' => $request->input_by,
            'input_at' => now(),
        ];

        Actual::updateOrCreate($searchConditions, $dataToUpdateOrCreate);

        flash()->success('Data created successfully.');
        return redirect()->to('actual/input-actual-employee?employee=' . $request->input('employee_id') . '&year=' . $yearToShow);
    }

    public function updateActual(Request $request)
    {
        $actual = Actual::find($request->actual_id);

        if (!$actual) {
            return abort(404, 'Actual not found');
        }
        if ($request->filled('status')) {
            $actual->status = $request->status;

            if ($request->status == 'Checked') {
                $actual->checked_at = now();
                $actual->checked_by = 'Mr. X';
            } elseif ($request->status == 'Approved') {
                $actual->approved_at = now();
                $actual->approved_by = 'Mr. Y';
            };
        }

        $actual->save();
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function updateActualDept(Request $request)
    {
        $actual = DepartmentActual::find($request->actual_id);

        if (!$actual) {
            return abort(404, 'Actual not found');
        }
        if ($request->filled('status')) {
            $actual->status = $request->status;

            if ($request->status === 'Checked') {
                $actual->checked_at = now();
            } elseif ($request->status === 'Approved') {
                $actual->approved_at = now();
            };
        }

        $actual->save();
        return response()->json(['message' => 'Status updated successfully']);
    }
}
