<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Actual;
use App\Models\Employee;
use Barryvdh\DomPDF\PDF;
use App\Mail\ApproveMail;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ActualDepartment;
use App\Models\DepartmentActual;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;

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
            ->leftJoin('target_units', 'target_units.id', '=', 'targets.target_unit_id')
            ->select('actuals.kpi_code as kpi_code', 'targets.code as code', 'actuals.date as actual_date', 'targets.date as target_date', 'targets.indicator as indicator', 'actuals.kpi_item')
            // ->where(DB::raw('MONTH(actuals.date)'), '<=', $now->month)
            ->where('actuals.employee_id', $employeeID)
            ->where(DB::raw('YEAR(actuals.date)'), '=', $year)
            ->get();

        $targetUnits1 = DB::table('target_units')->leftJoin('targets', 'targets.target_unit_id', '=', 'target_units.id')->select('target_1', 'target_2', 'target_3', 'target_4', 'target_5', 'target_6', 'targets.id as target_id', 'targets.date as month')->where('employee_id', '=', $employeeID)->whereYear('targets.date', '=', $year)->get();

        $targetUnits2 = DB::table('target_units')->leftJoin('targets', 'targets.target_unit_id', '=', 'target_units.id')->select('target_7', 'target_8', 'target_9', 'target_10', 'target_11', 'target_12',  'targets.id as target_id', 'targets.date as month')->where('employee_id', '=', $employeeID)->whereYear('targets.date', '=', $year)->get();


        // dd($actuals);
        return view('actual.input-actual-employee', [
            'title' => 'Input Data Realisasi',
            'desc' => 'Monitoring KPI',
            'employee' => $employee,
            'targets' => $targets,
            'actuals' => $actuals,
            'targetUnits1' => $targetUnits1,
            'targetUnits2' => $targetUnits2,
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

        $targetUnits1 = DB::table('target_units')->leftJoin('department_targets', 'department_targets.target_unit_id', '=', 'target_units.id')->select('target_1', 'target_2', 'target_3', 'target_4', 'target_5', 'target_6', 'department_targets.id as target_id', 'department_targets.date as month')->where('department_id', '=', $departmentID)->whereYear('department_targets.date', '=', $year)->get();

        $targetUnits2 = DB::table('target_units')->leftJoin('department_targets', 'department_targets.target_unit_id', '=', 'target_units.id')->select('target_7', 'target_8', 'target_9', 'target_10', 'target_11', 'target_12',  'department_targets.id as target_id', 'department_targets.date as month')->where('department_id', '=', $departmentID)->whereYear('department_targets.date', '=', $year)->get();


        return view('actual.input-actual-department-details', [
            'title' => 'Input Data Realisasi',
            'desc' => 'Monitoring KPI',
            'departments' => $department,
            'targets' => $targets,
            'actuals' => $actuals,
            'targetUnits1' => $targetUnits1,
            'targetUnits2' => $targetUnits2,
        ]);
    }

    public function department(Request $request)
    {
        $department = $request->query('department');
        $employee = $request->query('employee');
        $user = Auth::user();
        $role = $user->role;
        $email = $user->email;
        $authDept = $user->department_id;

        if ($role == 'Checker Div 1' || $role == 'Checker Div 2') {
            $dept = ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F'];
            $allDept = DB::table('departments')->whereIn('name', $dept)->get();
        } elseif ($role == 'FAD') {
            $dept = ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F', 'FAD', 'FSD'];
            $allDept = DB::table('departments')->whereIn('name', $dept)->get();
        } elseif ($role == 'Checker WS') {
            $dept = 'Workshop';
            $allDept = DB::table('departments')->where('name', '=', $dept)->get();
        } elseif ($role == 'Checker Factory') {
            $dept = 'Factory';
            $allDept = DB::table('departments')->where('name', '=', $dept)->get();
        } elseif ($email == 'tabrani@bskp.co.id' || $email == 'siswantoko@bskp.co.id') {
            $dept = ['Sub Div A', 'Sub Div B', 'Sub Div C', 'Sub Div D', 'Sub Div E', 'Sub Div F', 'Div 1', 'Div 2'];
            $allDept = DB::table('departments')->whereIn('name', $dept)->get();
        } elseif ($email == 'hendi@bskp.co.id') {
            $dept = ['Accounting', 'Finance'];
            $allDept = DB::table('departments')->whereIn('name', $dept)->get();
        } elseif ($role == 'Checker 1') {
            $allDept = DB::table('departments')->where('departments.id', $authDept)->get();
        } else {
            $allDept = DB::table('departments')->get();
        }

        if ($department && $employee) {
            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->where('employees.id', $employee)
                ->where('employees.is_active', 1)
                ->get();

            return view('actual.input-actual-department', [
                'title' => 'Input Data Realisasi',
                'desc' => 'List Karyawan',
                'departments' => $departments,
                'allDept' => $allDept,
            ]);
        } else if ($department) {
            // $userDepartmentID = Auth::user()->department_id;
            // if ($department != $userDepartmentID) {
            //     abort(403, 'Unauthorized');
            // }

            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('departments.id', $department)
                ->where('employees.is_active', 1)
                ->get();

            return view('actual.input-actual-department', [
                'title' => 'Input Data Realisasi',
                'desc' => 'List Karyawan',
                'departments' => $departments,
                'allDept' => $allDept,
            ]);
        } elseif ($employee) {
            $userDepartmentID = Auth::user()->id;
            if ($employee != $userDepartmentID) {
                abort(403, 'Unauthorized');
            }
            $departments = DB::table('departments')
                ->leftJoin('employees', 'employees.department_id', '=', 'departments.id')
                ->select('employees.id as employee_id', 'employees.nik as nik', 'employees.name as employee', 'employees.occupation as occupation', 'departments.name as department', 'departments.id as department_id')
                ->where('employees.id', $employee)
                ->where('employees.is_active', 1)
                ->get();

            return view('actual.input-actual-department', [
                'title' => 'Input Data Realisasi',
                'desc' => 'List Karyawan',
                'departments' => $departments,
                'allDept' => $allDept,
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


        // dd($targets);

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
        $user = Auth::user();
        $role = $user->role;

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'actual' => 'required',
            'record_file' => 'mimes:jpeg,pdf',
            'achievement' => 'required',

        ]);

        if ($validator->fails()) {
            flash()->error('Please fill all required field and upload a valid file format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $date = Carbon::createFromDate($request->year, $request->date, 1)->startOfMonth();


        if ($request->hasFile('record_file')) {
            $recordFile = $request->file('record_file');
            $extension = $recordFile->getClientOriginalExtension();

            if ($extension == 'jpeg' || $extension == 'jpg') {
                $image = $recordFile;
                $imageName = Str::random(40) . '.pdf';

                // Convert image to base64
                $imageBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($image));
                // dd($imageBase64, $imageName, $image);

                // Generate PDF with the image
                $pdf = app('dompdf.wrapper');
                $res = $pdf->loadView('pdf.image', ['imageData' => $imageBase64]);

                // Save the PDF
                $pdf->save(public_path('record_files/' . $imageName));
                $recordFileName = $imageName; // Store the PDF file name
            } else {
                $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
                $recordFile->move(public_path('record_files'), $recordFileName);
            }
        }

        $semester = '';

        if ($request->date > 6 && $request->date <= 12) {
            $semester = '2';
        } else {
            $semester = '1';
        }

        $input_by = Auth::user()->name;

        $actual = '';
        $target = '';
        $kpi_percentage = '';
        if ($request->record_file == null) {
            $target = $request->target;
            $actual = '0';
            $kpi_percentage = '0';
        } else {
            $cleanedActual = str_replace(',', '', $request->actual);
            $cleanedTarget = str_replace(',', '', $request->target);
            $target = floatval($cleanedTarget);
            $actual = floatval($cleanedActual);
            $kpi_percentage = $request->achievement;
        }


        $searchConditions = [
            'kpi_code' => $request->kpi_code,
            'date' => $date,
            'department_id' => $request->department_id,
        ];

        $existingActual = DB::table('department_actuals')->where($searchConditions)
            ->whereIn('status', ['Checked', 'Approved'])->first();
        // dd($existingActual);

        if ($existingActual && ($role != 'Approver')) {
            flash()->error('This KPI item already checked or approved');
            return redirect()->back()->withErrors(['status' => 'Cannot update or create record: Data sudah di check atau di approve.']);
        }

        $dataToUpdateOrCreate = [
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'kpi_unit' => $request->kpi_unit,
            'review_period' => $request->review_period,
            'target' => $target ?? 0,
            'actual' => $actual ?? 0,
            'kpi_percentage' => $kpi_percentage ?? 0,
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
            'input_by' => $input_by,
            'input_at' => now(),
        ];

        DepartmentActual::updateOrCreate($searchConditions, $dataToUpdateOrCreate);
        flash()->success('Data created successfully.');
        return redirect()->to('actual/input-actual-department-details?department=' . $request->input('department_id') . '&year=' . $request->input('year') . '&semester=' . $semester);
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $role = $user->role;

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'actual' => 'required',
            'record_file' => 'mimes:jpeg,pdf',
            'achievement' => 'required',
        ]);
        if ($validator->fails()) {
            flash()->error('Please fill all required field and upload a valid file format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $date = Carbon::createFromDate($request->year, $request->date, 1)->startOfMonth();

        if ($request->hasFile('record_file')) {
            $recordFile = $request->file('record_file');
            $extension = $recordFile->getClientOriginalExtension();

            if ($extension == 'jpeg' || $extension == 'jpg') {
                $image = $recordFile;
                $imageName = Str::random(40) . '.pdf';

                // Convert image to base64
                $imageBase64 = "data:image/jpg;base64," . base64_encode(file_get_contents($image));
                // dd($imageBase64, $imageName, $image);

                // Generate PDF with the image
                $pdf = app('dompdf.wrapper');
                $res = $pdf->loadView('pdf.image', ['imageData' => $imageBase64]);

                // Save the PDF
                $pdf->save(public_path('record_files/' . $imageName));
                $recordFileName = $imageName; // Store the PDF file name
            } else {
                $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
                $recordFile->move(public_path('record_files'), $recordFileName);
            }
        }

        $semester = '';

        if ($request->date > 6 && $request->date <= 12) {
            $semester = '2';
        } else {
            $semester = '1';
        }
        $actual = '';
        $target = '';
        $kpi_percentage = '';
        if ($request->record_file == null) {
            $cleanedTarget = str_replace(',', '', $request->target);
            $target = floatval($cleanedTarget);
            $actual = '0';
            $kpi_percentage = '0';
        } else {
            $cleanedActual = str_replace(',', '', $request->actual);
            $cleanedTarget = str_replace(',', '', $request->target);
            $target = floatval($cleanedTarget);
            $actual = floatval($cleanedActual);
            $kpi_percentage = $request->achievement;
        }

        if ($role == 'Approver' || $role == 'Checker Div 1' || $role == 'Checker Div 2') {
            $input_by = $request->name;
        } else {
            $input_by = Auth::user()->name;
        }

        $searchConditions = [
            'kpi_code' => $request->kpi_code,
            'date' => $date,
            'employee_id' => $request->employee_id,
        ];

        // $existingActual = DB::table('actuals')->where($searchConditions)
        //     ->whereIn('status', ['Checked', 'Approved'])->first();
        // // dd($existingActual);

        // if ($existingActual && ($role != 'Approver')) {
        //     flash()->error('This KPI item already Checked or Approved');
        //     return redirect()->back()->withErrors(['status' => 'Cannot update or create record: Data sudah di check atau di approve.']);
        // }


        $dataToUpdateOrCreate = [
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'kpi_unit' => $request->kpi_unit,
            'review_period' => $request->review_period,
            'target' => $target ?? 0,
            'actual' => $actual ?? 0,
            'kpi_percentage' => $kpi_percentage ?? 0,
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
            'input_by' => $input_by,
            'input_at' => now(),
        ];

        Actual::updateOrCreate($searchConditions, $dataToUpdateOrCreate);

        flash()->success('Data created successfully.');
        return redirect()->to('actual/input-actual-employee?employee=' . $request->input('employee_id') . '&year=' . $request->input('year') . '&semester=' . $semester);
    }

    public function updateActual(Request $request)
    {
        $actual = Actual::find($request->actual_id);
        $user = Auth::user()->name;


        if (!$actual) {
            return view('components/404-page');
        }
        if ($request->filled('status')) {
            $actual->status = $request->status;

            if ($request->status == 'Checked 1') {
                $actual->asst_mng_checked_at = now();
                $actual->asst_mng_checked_by = $user;
            } else if ($request->status == 'Checked 2') {
                $actual->checked_at = now();
                $actual->checked_by = $user;
            } elseif ($request->status == 'Mng Approve') {
                $actual->mng_approved_at = now();
                $actual->mng_approved_by = $user;
            } elseif ($request->status == 'Approved') {
                $actual->approved_at = now();
                $actual->approved_by = $user;
            };
        }

        $actual->save();
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function updateActualDept(Request $request)
    {
        $actual = DepartmentActual::find($request->actual_id);
        $user = Auth::user()->name;


        if (!$actual) {
            return view('components/404-page');
        }
        if ($request->filled('status')) {
            $actual->status = $request->status;

            if ($request->status == 'Checked 1') {
                $actual->asst_mng_checked_at = now();
                $actual->asst_mng_checked_by = $user;
            } else if ($request->status == 'Checked 2') {
                $actual->checked_at = now();
                $actual->checked_by = $user;
            } elseif ($request->status == 'Mng Approve') {
                $actual->mng_approved_at = now();
                $actual->mng_approved_by = $user;
            } elseif ($request->status == 'Approved') {
                $actual->approved_at = now();
                $actual->approved_by = $user;
            };
        }

        $actual->save();
        return response()->json(['message' => 'Status updated successfully']);
    }

    public function batchUpdateActual(Request $request)
    {
        $selectedTargets = explode(',', $request->input('selected_targets', ''));
        $targetCodes = explode(',', $request->input('target_codes', ''));
        $month = $request->month;
        $year = $request->year;
        $user = Auth::user();
        $name = $user->name;
        $role = $user->role;
        $status = '';
        $from = $user->email;
        $nik = $request->nik;
        $userID = $request->employee_id;

        $sendTo = DB::table('employees')
            ->where('nik', $nik)
            ->select('employees.email')
            ->first();

        $details = [
            'approved_by' => $from,
            'email' => $sendTo,
            'title' => 'Notifikasi Persetujuan KPI',
            'msg' => 'Dengan Hormat saya sampaikan bahwa KPI anda telah disetujui. Terima kasih atas kerjasamanya',
        ];

        // dd($details);
        // dd($targetCodes);

        if ($role == 'Checker 1' || $role == 'Checker Factory' || $role == 'Checker WS') {
            $status = 'Checked 1';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('actuals')->whereYear('actuals.date', '=', $year)
                    ->whereMonth('actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('status', '=', 'Filled')
                    ->where('employee_id', $userID)
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'asst_mng_checked_by' => $name,
                            'asst_mng_checked_at' => now(),
                        ]
                    );
            }
        } elseif ($role == 'Checker Div 1' || $role == 'Checker Div 2') {
            $status = 'Checked 2';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('actuals')->whereYear('actuals.date', '=', $year)
                    ->whereMonth('actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('status', '=', 'Checked 1')
                    ->where('employee_id', $userID)
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'checked_by' => $name,
                            'checked_at' => now(),
                        ]
                    );
            }
        } elseif ($role == 'Mng Approver') {
            $status = 'Mng Approve';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('actuals')->whereYear('actuals.date', '=', $year)
                    ->whereMonth('actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('employee_id', $userID)
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'mng_approved_by' => $name,
                            'mng_approved_at' => now(),
                        ]
                    );
            }
        } else if ($role == 'Approver') {
            $status = 'Approved';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('actuals')->whereYear('actuals.date', '=', $year)
                    ->whereMonth('actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('employee_id', $userID)
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'approved_by' => $name,
                            'approved_at' => now(),
                        ]
                    );
            }
        } else {
            return back()->with('error', 'An Error Occured');
        }


        if ($sendTo != null || $sendTo != 0) {
            Mail::to($details['email'])->send(new ApproveMail($details));
        }

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    public function batchUpdateActualDept(Request $request)
    {
        $selectedTargets = explode(',', $request->input('selected_targets', ''));
        $targetCodes = explode(',', $request->input('target_codes', ''));
        $month = $request->month;
        $year = $request->year;
        $user = Auth::user();
        $from = $user->email;
        $name = $user->name;
        $role = $user->role;
        $status = '';
        $departmentID = $request->department_id;


        $sendTo = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->where('employees.department_id', $departmentID)
            ->where('employees.occupation', '=', 'Asst Mng')
            ->select('employees.email')
            ->first();

        $details = [
            'approved_by' => $from,
            'email' => $sendTo,
            'title' => 'Notifikasi Persetujuan KPI',
            'msg' => 'Dengan Hormat saya sampaikan bahwa KPI Departemen anda telah disetujui. Terima kasih atas kerjasamanya',
        ];

        // dd($details);


        if ($role == 'Checker 1' || $role == 'Checker Factory' || $role == 'Checker WS') {
            $status = 'Checked 1';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('department_actuals')->whereYear('department_actuals.date', '=', $year)
                    ->whereMonth('department_actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('status', '=', 'Filled')
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'asst_mng_checked_by' => $name,
                            'asst_mng_checked_at' => now(),
                        ]
                    );
            }
        } elseif ($role == 'Checker Div 1' || $role == 'Checker Div 2') {
            $status = 'Checked 2';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('department_actuals')->whereYear('department_actuals.date', '=', $year)
                    ->whereMonth('department_actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('status', '=', 'Checked 1')
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'checked_by' => $name,
                            'checked_at' => now(),
                        ]
                    );
            }
        } elseif ($role == 'Mng Approver') {
            $status = 'Mng Approve';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('department_actuals')->whereYear('department_actuals.date', '=', $year)
                    ->whereMonth('department_actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'mng_approved_by' => $name,
                            'mng_approved_at' => now(),
                        ]
                    );
            }
        } else if ($role == 'Approver') {
            $status = 'Approved';
            foreach ($selectedTargets as $index => $targetId) {
                $targetCode = $targetCodes[$index];

                DB::table('department_actuals')->whereYear('department_actuals.date', '=', $year)
                    ->whereMonth('department_actuals.date', '=', $month)
                    ->where('kpi_code', '=', $targetCode)
                    ->where('record_file', '!=', '')
                    ->update(
                        [
                            'status' => $status,
                            'approved_by' => $name,
                            'approved_at' => now(),
                        ]
                    );
            }
        } else {
            return back()->with('error', 'An Error Occured');
        }

        if ($sendTo != null || $sendTo != 0) {
            Mail::to($details['email'])->send(new ApproveMail($details));
        }


        return redirect()->back()->with('success', 'Data Updated Successfully');
    }
}
