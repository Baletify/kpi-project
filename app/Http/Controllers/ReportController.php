<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Employee;

class ReportController extends Controller
{
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('report.employee-report', ['title' => 'Report', 'desc' => 'Employee Report', 'employee' => $employee]);
    }

    public function department()
    {
        return view('report.department-report', ['title' => 'Report', 'desc' => 'Department']);
    }
}
