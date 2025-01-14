<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Target;
use App\Models\Employee;
use Illuminate\View\View;
use App\Models\Department;
use App\Models\TargetUnit;
use Illuminate\Http\Request;
use App\Imports\TargetImport;
use Dflydev\DotAccessData\Data;
use App\Models\DepartmentTarget;
use App\Imports\TargetDeptImport;
use App\Imports\TargetUnitImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class TargetController extends Controller
{
    public function index()
    {
        $employees = DB::table('employees')->leftJoin('departments', 'employees.department_id', '=', 'departments.id')->leftJoin('targets', 'employees.id', '=', 'targets.employee_id')
            ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department')->distinct()->get();

        return view('/target/input-target-employee', ['title' => 'Input KPI Target', 'desc' => 'Employees', 'employees' => $employees]);
    }

    public function show(Request $request)
    {
        $employeeID = $request->query('employee');
        $year = $request->query('year');
        $semester = $request->query('semester');


        if ($employeeID && $year && $semester) {
            $employee = DB::table('employees')->leftJoin('departments', 'departments.id', 'employees.department_id')
                ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department')
                ->where('employees.id', '=', $employeeID)->first();

            $targets = DB::table('targets')->leftJoin('target_units', 'target_units.id', '=', 'targets.target_unit_id')
                ->select('target_units.*', 'targets.*', DB::raw('YEAR(targets.date) as year'))
                ->where('employee_id', $employeeID)
                ->where(DB::raw('YEAR(targets.date)'), $year)
                ->get();

            return view('target.input-target-kpi', ['title' => 'Input KPI Target', 'desc' => 'Employees', 'employee' => $employee, 'targets' => $targets]);
        } else {

            abort(404, 'No actuals found for the given year and semester');
        }
    }

    public function showDept(Request $request)
    {
        $departmentID = $request->query('department');
        $year = $request->query('year');
        $semester = $request->query('semester');

        if ($departmentID && $year) {
            $dept = DB::table('departments')->where('departments.id', '=', $departmentID)
                ->first();

            if (!$dept) {
                abort(404, 'Department not found');
            }

            $targetDept = DB::table('department_targets')->leftJoin('departments', 'departments.id', '=', 'department_targets.department_id')
                ->leftJoin('target_units', 'department_targets.target_unit_id', '=', 'target_units.id')
                ->select('department_targets.id', 'department_targets.department_id', 'department_targets.target_unit_id', 'department_targets.trend', 'departments.name as department', 'department_targets.code', 'department_targets.indicator', 'department_targets.calculation', 'department_targets.supporting_document', 'department_targets.period', 'department_targets.weighting', 'department_targets.unit', 'target_units.target_1', 'target_units.target_2', 'target_units.target_3', 'target_units.target_4', 'target_units.target_5', 'target_units.target_6', 'target_units.target_7', 'target_units.target_8', 'target_units.target_9', 'target_units.target_10', 'target_units.target_11', 'target_units.target_12', 'department_targets.id as department_target_id')
                ->where('departments.id', '=', $departmentID)
                ->where(DB::raw('YEAR(department_targets.date)'), $year)
                ->get();

            // dd($targetDept);

            return view('target.input-target-kpi-department', ['title' => 'Input KPI Target', 'desc' => 'Department', 'departments' => $dept, 'targets' => $targetDept]);
        } else {

            return view('components/404-page');
        }
    }

    public function department(Request $request)
    {
        $departmentID = $request->query('department');
        $employeeID = $request->query('employee');

        if ($departmentID) {
            $userDepartmentID = Auth::user()->department_id;
            if ($departmentID != $userDepartmentID && Auth::user()->role != 'Superadmin') {
                abort(403, 'Unauthorized');
            }

            $departments = DB::table('departments')->where('departments.id', $departmentID)
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->leftJoin('action_plans', 'action_plans.employee_id', '=', 'employees.id')
                ->select('employees.id as employee_id', 'employees.name as employee', 'employees.nik as nik', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id', 'action_plans.file as file', 'action_plans.id as action_plan_id')
                ->get();

            return view('target.input-target-department', ['title' => 'Input Target', 'desc' => 'Input KPI Target & Upload Program', 'departments' => $departments]);
        } elseif ($employeeID) {
            $userID = Auth::user()->id;
            if ($employeeID != $userID && Auth::user()->role != 'Superadmin') {
                abort(403, 'Unauthorized');
            }
            $departments = DB::table('employees')->where('employees.id', $employeeID)
                ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->leftJoin('action_plans', 'action_plans.employee_id', '=', 'employees.id')
                ->select('employees.id as employee_id', 'employees.name as employee', 'employees.nik as nik', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id', 'action_plans.file as file', 'action_plans.id as action_plan_id')
                ->get();

            return view('target.input-target-department', ['title' => 'Input Target', 'desc' => 'Input KPI Target & Upload Program', 'departments' => $departments]);
        } else {
            return view('components/404-page');
        }
    }

    public function showImport()
    {
        return view('target.import-target-kpi-employee', ['title' => 'Import Target', 'desc' => 'Import Target Employee ']);
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx',
        ]);

        if ($validator->fails()) {
            flash()->error('Import target only accept .xlsx format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Import the data without saving the file
        Excel::import(new TargetImport($this), $request->file('file'));

        return back();
    }

    public function storeTarget(array $row, $targetUnitId, $year)
    {
        $employee = DB::table('employees')->where('nik', $row['nik'])->value('id');
        // dd($employee);
        $yearToInsert = $year;


        $searchConditions = [
            'date' => $yearToInsert,
            'employee_id' => $employee,
            'code' => $row['kode_kpi']
        ];

        $weighting = isset($row['bobot']) ? ((float)$row['bobot'] * 100) . '%' : '0%';

        $data = [
            'code' => $row['kode_kpi'],
            'indicator' => $row['kpi'],
            'calculation' => $row['cara_menghitung'],
            'supporting_document' => $row['data_pendukung_harus_di_isi'],
            'trend' => $row['trend'],
            'period' => $row['periode_review'],
            'unit' => $row['unit'],
            'weighting' => $weighting,
            'detail' => $row['keterangan'],
            'target_unit_id' => $targetUnitId,
        ];

        // dd($data);

        Target::updateOrCreate($searchConditions, $data);
    }

    public function showImportDept()
    {
        return view('target.import-target-kpi-department', ['title' => 'Import Target', 'desc' => 'Import Target Department']);
    }

    public function importDept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx',
        ]);

        if ($validator->fails()) {
            flash()->error('Import target only accept .xlsx format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Import the data without saving the file
        Excel::import(new TargetDeptImport($this), $request->file('file'));

        return back();
    }

    public function storeTargetDept(array $row, $targetUnitId, $year, $department_id)
    {
        // dd($row);
        $department = DB::table('departments')->where('id', '=', $department_id)->value('id');
        // dd($department);
        $yearToInsert = $year;

        $weighting = isset($row['bobot']) ? ((float)$row['bobot'] * 100) . '%' : '0%';

        $searchConditions = [
            'date' => $yearToInsert,
            'department_id' => $department,
            'code' => $row['kode_kpi']
        ];

        $data = [
            'code' => $row['kode_kpi'],
            'indicator' => $row['kpi'],
            'calculation' => $row['cara_menghitung'],
            'supporting_document' => $row['data_pendukung_harus_di_isi'],
            'trend' => $row['trend'],
            'period' => $row['periode_review'],
            'unit' => $row['unit'],
            'weighting' => $weighting,
            'detail' => $row['penjelasan'],
            'target_unit_id' => $targetUnitId,
        ];

        // dd($data);

        $response = DepartmentTarget::updateOrCreate($searchConditions, $data);
        // dd($response);
    }

    public function edit($id)
    {
        $target = DB::table('targets')->leftJoin('target_units', 'target_units.id', '=', 'targets.target_unit_id')
            ->select('target_units.*', 'targets.*', DB::raw('YEAR(targets.date) as year'), 'targets.id as target_id', 'target_units.id as target_unit_id')
            ->where('targets.id', $id)
            ->first();

        return view('target.edit-target-kpi', ['title' => 'Edit Data Target', 'desc' => 'Edit Target Employee', 'target' => $target]);
    }
    public function editDept($id)
    {
        $target = DB::table('department_targets')->leftJoin('target_units', 'target_units.id', '=', 'department_targets.target_unit_id')
            ->select('target_units.*', 'department_targets.*', DB::raw('YEAR(department_targets.date) as year'), 'department_targets.id as department_target_id', 'target_units.id as target_unit_id')
            ->where('department_targets.id', $id)
            ->first();

        return view('target.edit-target-kpi-department', ['title' => 'Edit Data Target', 'desc' => 'Edit Target Department', 'target' => $target]);
    }

    public function update(Request $request)
    {
        $id = $request->target_id;
        $year = $request->year;
        $employee_id = $request->employee_id;
        $targetUnitId = $request->target_unit_id;

        $target = Target::find($id);
        $target->update(request()->all());
        $targetUnit = TargetUnit::find($targetUnitId);
        $targetUnit->update(request()->all());

        return redirect()->to('/target/input-target-kpi?employee=' . $employee_id . '&year=' . $year)->with('success', 'Data updated successfully.');
    }

    public function updateDept(Request $request)
    {
        $id = $request->department_target_id;
        $year = $request->year;
        $departmentID = $request->department_id;

        $target = DepartmentTarget::find($id);
        $target->update(request()->all());

        return redirect()->to('/target/input-target-kpi-department?department=' . $departmentID . '&year=' . $year)->with('success', 'Data updated successfully.');
    }

    public function departmentTargetReport(Request $request)
    {
        $targets = DB::table('department_targets')->leftJoin('departments', 'departments.id', '=', 'department_targets.department_id')
            ->leftJoin('target_units', 'target_unit.id', '=', 'department_targets.target_unit_id')
            ->where('department_targets.date', '=', $request->year)->where('department_targets.item', '=', $request->item)
            ->get();
    }
}
