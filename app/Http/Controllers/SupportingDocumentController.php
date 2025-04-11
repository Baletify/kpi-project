<?php

namespace App\Http\Controllers;

use App\Models\Actual;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\DepartmentActual;
use Illuminate\Support\Facades\DB;

class SupportingDocumentController extends Controller
{
    public function index(Request $request)
    {
        $department = $request->query('department');

        if ($department) {
            $employees = DB::table('employees')
                ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
                ->where('employees.department_id', $department)
                ->select('employees.id', 'employees.name', 'employees.nik', 'employees.occupation', 'departments.name as department')
                ->get();
            $departments = DB::table('departments')
                ->select('id', 'name')
                ->get();
        } else {
            return view('supporting-documents.employee-list', [
                'title' => 'Lihat Data Pendukung',
                'desc' => 'Employee List',
            ]);
        }

        return view('supporting-documents.employee-list', [
            'title' => 'Lihat Data Pendukung',
            'desc' => 'Employee List',
            'employees' => $employees,
            'departments' => $departments,
        ]);
    }

    public function indexDept()
    {
        $departments = DB::table('departments')
            ->get();

        return view('supporting-documents.department-list', [
            'title' => 'Lihat Data Pendukung',
            'desc' => 'Department List',
            'departments' => $departments,
        ]);
    }

    public function employeeSupportingDocumentList(Request $request)
    {
        $employeeQuery = $request->query('employee');
        $yearQuery = $request->query('year');

        $employeeDetail = DB::table('employees')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->where('employees.id', $employeeQuery)
            ->select('employees.name', 'nik', 'occupation', 'departments.name as department')
            ->first();

        $targets = DB::table('targets')->leftJoin('target_units', 'targets.target_unit_id', '=', 'target_units.id')
            ->where('targets.employee_id', $employeeQuery)
            ->whereYear('targets.date', $yearQuery)
            ->select('targets.*', 'target_units.*')
            ->get();

        $actuals = DB::table('actuals')->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
            ->where('employees.id', $employeeQuery)
            ->whereYear('actuals.date', $yearQuery)
            ->select('actuals.*', 'employees.name as employee_name', 'employees.nik as employee_nik', 'employees.id as employee_id')
            ->get();

        return view('supporting-documents.employee-supporting-document', [
            'title' => 'Lihat Data Pendukung',
            'desc' => 'Employee Supporting Document List',
            'targets' => $targets,
            'actuals' => $actuals,
            'employee' => $employeeDetail,
        ]);
    }

    public function departmentSupportingDocumentList(Request $request)
    {
        $departmentQuery = $request->query('department');
        $yearQuery = $request->query('year');

        $departmentDetail = DB::table('departments')
            ->where('departments.id', $departmentQuery)
            ->select('departments.name')
            ->first();

        $targets = DB::table('department_targets')->leftJoin('target_units', 'department_targets.target_unit_id', '=', 'target_units.id')
            ->where('department_targets.department_id', $departmentQuery)
            ->whereYear('department_targets.date', $yearQuery)
            ->select('department_targets.*', 'target_units.*')
            ->get();

        $actuals = DB::table('department_actuals')->leftJoin('departments', 'department_actuals.department_id', '=', 'departments.id')
            ->where('department_actuals.department_id', $departmentQuery)
            ->whereYear('department_actuals.date', $yearQuery)
            ->select('department_actuals.*', 'departments.name as department_name', 'departments.code as department_code', 'departments.id as department_id')
            ->get();

        return view('supporting-documents.department-supporting-document', [
            'title' => 'Lihat Data Pendukung',
            'desc' => 'Department Supporting Document List',
            'targets' => $targets,
            'actuals' => $actuals,
            'department' => $departmentDetail,
        ]);
    }

    public function showFile(Request $request)
    {
        $month = $request->query('month');
        $actualId = $request->query('actual_id');

        $pdfUrls = Actual::whereMonth('date', $month)
            ->where('id', $actualId)
            ->get(['id', 'record_file', 'kpi_code', 'kpi_item', 'status', 'comment'])
            ->toArray();

        return response()->json($pdfUrls);
    }
    public function showFileDept(Request $request)
    {
        $month = $request->query('month');
        $actualId = $request->query('actual_id');

        $pdfUrls = DepartmentActual::whereMonth('date', $month)
            ->where('id', $actualId)
            ->get(['id', 'record_file', 'kpi_code', 'kpi_item', 'status', 'comment'])
            ->toArray();

        return response()->json($pdfUrls);
    }
}
