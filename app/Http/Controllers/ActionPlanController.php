<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ActionPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ActionPlanDept;
use App\Models\DeptActionPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ActionPlanController extends Controller
{
    public function show(Request $request)
    {
        $department = $request->query('department');

        if ($department) {
            $employees = DB::table('employees')->leftJoin('action_plans', 'action_plans.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where('employees.department_id', $department)
                ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department', 'action_plans.file as file', 'action_plans.id as action_plan_id')
                ->get();

            return view('action-plan.action-plans', ['title' => 'Action Plan', 'desc' => 'View Action Plan', 'employees' => $employees]);
        } else {
            return view('components/404-page');
        }
    }

    public function addEmployeeFile($id)
    {
        $employee = DB::table('employees')->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->where('employees.id', $id)
            ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department', 'departments.id as department_id')
            ->first();

        return view('action-plan.input-action-plan', ['title' => 'Action Plan', 'desc' => 'Input Action Plan', 'employee' => $employee]);
    }

    public function addDeptFile($id)
    {
        $department = DB::table('departments')
            ->where('departments.id', $id)
            ->select('departments.*')
            ->first();

        return view('action-plan.input-action-plan-dept', ['title' => 'Action Plan', 'desc' => 'Input Action Plan', 'department' => $department]);
    }

    public function storeFile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'action_plan_file' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            flash()->error('Only accept .pdf format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('action_plan_file')) {
            $recordFile = $request->file('action_plan_file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('action_plan_files'), $recordFileName);
        }


        $employeeID = $request->employee_id;

        $searchCondition = [
            'employee_id' => $employeeID,
        ];

        $updateCondition = [
            'file_name' => $request->file_name,
            'file' => $recordFileName
        ];

        $response = ActionPlan::updateOrCreate($searchCondition, $updateCondition);


        if (Auth::user()->input_type == 'Group') {
            return redirect()->route('target.department', ['department' => $request->department_id])->with('success', 'Action Plan has been added');
        } else {
            return redirect()->route('target.department', ['employee' => $request->employee_id])
                ->with('success', 'Action Plan has been added');
        }
    }

    public function storeFileDept(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'action_plan_file' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            flash()->error('Only accept .pdf format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $year = $request->year;
        $semester = $request->semester;
        // dd($request->all());

        if ($request->hasFile('action_plan_file')) {
            $recordFile = $request->file('action_plan_file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('action_plan_files'), $recordFileName);
        }

        $departmentID = $request->department_id;
        // dd($departmentID);

        $searchCondition = [
            'department_id' => $departmentID,
        ];

        $updateCondition = [
            'file_name' => $request->file_name,
            'file' => $recordFileName
        ];

        $response = DeptActionPlan::updateOrCreate($searchCondition, $updateCondition);

        flash()->success('Action Plan has been added');

        return redirect()->route('target.showDeptOne', ['department' => $request->department_id, 'year' => $year, 'semester' => $semester]);
    }

    public function showFile($filename)
    {
        $path = public_path('action_plan_files/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }



    public function editFile($id)
    {
        $employee = DB::table('employees')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->leftJoin('action_plans', 'action_plans.employee_id', 'employees.id')
            ->where('action_plans.id', $id)
            ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department', 'departments.id as department_id', 'action_plans.file as file', 'action_plans.id as action_plan_id')
            ->first();


        return view('action-plan.edit-action-plan', ['title' => 'Action Plan', 'desc' => 'Edit Action Plan', 'employee' => $employee]);
    }
    public function editDeptFile($id)
    {

        $department = DB::table('departments')
            ->where('departments.id', $id)
            ->select('departments.*')
            ->first();
        // dd($department);

        return view('action-plan.input-action-plan-dept', ['title' => 'Action Plan', 'desc' => 'Input Action Plan', 'department' => $department]);
    }

    public function updateFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action_plan_file' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            flash()->error('Only accept .pdf format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $actionPlan = ActionPlan::find($request->action_plan_id);

        if ($request->hasFile('action_plan_file')) {
            if ($actionPlan->file && file_exists(public_path('action_plan_files/' . $actionPlan->file))) {
                unlink(public_path('action_plan_files/' . $actionPlan->file));
            }
            $recordFile = $request->file('action_plan_file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('action_plan_files'), $recordFileName);;
        }

        $actionPlan->update(
            [
                'employee_id' => $request->employee_id,
                'file_name' => $request->file_name,
                'file' => $recordFileName
            ]
        );

        flash()->success('Action Plan has been added');

        if (Auth::user()->input_type == 'Group') {
            return redirect()->route('target.department', ['department' => $request->department_id]);
        } else {
            return redirect()->route('target.department', ['employee' => $request->employee_id]);
        }
    }

    public function updateDeptFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action_plan_file' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            flash()->error('Only accept .pdf format');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $year = $request->year;
        $semester = $request->semester;
        dd($request->all());

        if ($request->hasFile('action_plan_file')) {
            $recordFile = $request->file('action_plan_file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('action_plan_files'), $recordFileName);
        }

        $departmentID = $request->department_id;

        $searchCondition = [
            'department_id' => $departmentID,
        ];

        $updateCondition = [
            'file_name' => $request->file_name,
            'file' => $recordFileName
        ];

        $response = DeptActionPlan::updateOrCreate($searchCondition, $updateCondition);

        flash()->success('Action Plan has been added');

        return redirect()->route('target.showDeptOne', ['department' => $departmentID, 'year' => $year, 'semester' => $semester]);
    }
}
