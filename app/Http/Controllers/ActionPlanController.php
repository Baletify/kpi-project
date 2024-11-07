<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\ActionPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActionPlanController extends Controller
{
    public function show(Request $request)
    {
        $department = $request->query('department');

        if ($department) {
            $employees = DB::table('employees')->leftJoin('action_plans', 'action_plans.employee_id', '=', 'employees.id')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where('employees.department_id', $department)
                ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department', 'action_plans.file as file')
                ->get();

            return view('action-plan.action-plans', ['title' => 'Action Plan', 'desc' => 'View Action Plan', 'employees' => $employees]);
        } else {
            abort(404, 'No action plans found for the given department');
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
            $recordFile->move(public_path('action_plan_files'), $recordFileName);;
        }

        ActionPlan::create(
            [
                'employee_id' => $request->employee_id,
                'file_name' => $request->file_name,
                'file' => $recordFileName
            ]
        );

        return redirect()->route('action-plan.show', ['department' => $request->department_id]);
    }
}
