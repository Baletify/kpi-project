<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Preview;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PreviewController extends Controller
{
    public function store(Request $request)
    {

        $date = Carbon::createFromDate($request->year, $request->date, 1)->startOfMonth();
        if ($request->hasFile('program_file')) {
            $programFile = $request->file('program_file');
            $programFileName = Str::random(40) . '.' . $programFile->getClientOriginalExtension();
            $programFile->move(public_path('program_files'), $programFileName);
        }

        if ($request->hasFile('record_file')) {
            $recordFile = $request->file('record_file');
            $recordFileName = Str::random(40) . '.' . $recordFile->getClientOriginalExtension();
            $recordFile->move(public_path('record_files'), $recordFileName);;
        }
        Preview::create([
            'kpi_code' => $request->kpi_code,
            'kpi_item' => $request->kpi_item,
            'kpi_unit' => $request->kpi_unit,
            'review_period' => $request->review_period,
            'program_number' => $request->program_number,
            'program_file' => isset($programFileName) ? $programFileName : null,
            'target' => $request->target,
            'actual' => $request->actual,
            'kpi_calculation' => $request->kpi_calculation,
            'supporting_document' => $request->supporting_document,
            'comment' => $request->comment,
            'record_file' => isset($recordFileName) ? $recordFileName : null,
            'department_name' => $request->department_name,
            'kpi_weighting' => $request->kpi_weighting,
            'date' => $date,
            'employee_id' => $request->pv_employee_id,

        ]);

        return redirect()->route('preview.show', ['id' => $request->employee_id])->with('success', 'preview');
    }

    public function show($id)
    {

        $employee = Employee::find($id);
        $previews = DB::table('previews')
            ->leftJoin('employees', 'employees.id', '=', 'previews.employee_id')
            ->leftJoin('actuals', 'actuals.kpi_code', '=', 'previews.kpi_code')
            ->select('previews.id', 'previews.kpi_code', 'previews.kpi_item', 'previews.kpi_unit', 'previews.review_period', 'previews.program_number', 'previews.program_file', 'previews.target', 'previews.actual', 'previews.kpi_calculation', 'previews.supporting_document', 'previews.comment', 'previews.record_file', 'previews.department_name', 'previews.kpi_weighting', 'previews.date', 'previews.employee_id', 'employees.nik as nik', 'employees.occupation as occupation', 'employees.name as employee',)
            ->where('previews.employee_id', $id)->get();


        return view('actual.input-actual-preview', ['title' => 'Input Data Realisasi', 'desc' => 'Preview', 'previews' => $previews, 'employee' => $employee]);
    }
}
