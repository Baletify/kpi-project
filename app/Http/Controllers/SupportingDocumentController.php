<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        ]);
    }

    public function indexDept(Request $request) {}
}
