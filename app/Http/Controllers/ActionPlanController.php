<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ActionPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

    public function storeFile(Request $request)
    {
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

        ActionPlan::updateOrCreate($searchCondition, $updateCondition);
        flash()->success('Action Plan has been added');
        if (Auth::user()->input_type == 'Group') {
            return redirect()->route('target.department', ['department' => $request->department_id])->with('success', 'Action Plan has been added');
        } else {
            return redirect()->route('target.department', ['employee' => $request->employee_id])
                ->with('success', 'Action Plan has been added');
        }
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

    public function updateFile(Request $request)
    {
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
}
