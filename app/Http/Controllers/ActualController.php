<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Actual;

class ActualController extends Controller
{
    public function show($id)
    {
        $now = Carbon::now();
        $employee = Employee::find($id);

        // Ambil data targets
        $targets = DB::table('targets')
            ->select('id', 'code', 'indicator', 'employee_id')
            ->where('employee_id', $id)
            ->get();

        // Ambil data actuals
        $actuals = DB::table('actuals')
            ->leftJoin('employees', 'actuals.employee_id', '=', 'employees.id')
            ->leftJoin('targets', 'actuals.kpi_code', '=', 'targets.code')
            // ->select('actuals.date as date', 'actuals.employee_id as employee_id', 'targets.code as code', 'targets.indicator as indicator')
            ->where(DB::raw('MONTH(actuals.date)'), '<=', $now->month)
            ->where('actuals.employee_id', $id)
            ->get();

        return view('actual.input-actual-employee', [
            'title' => 'Input Data Realisasi',
            'desc' => 'Achievement',
            'employee' => $employee,
            'targets' => $targets,
            'actuals' => $actuals
        ]);
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $targets = DB::table('targets')->leftJoin('target_units', 'target_units.id', '=', 'targets.target_unit_id')
            ->leftJoin('employees', 'employees.id', '=', 'targets.employee_id')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')->where('targets.id', '=', $id)
            ->select('targets.id', 'targets.employee_id', 'targets.code', 'targets.indicator', 'targets.calculation', 'targets.period', 'targets.unit', 'targets.supporting_document', 'targets.weighting', 'target_units.id as target_unit_id', 'employees.nik as nik', 'employees.occupation as occupation', 'employees.name as employee', 'departments.name as department', 'target_1 as target_unit_1', 'target_2 as target_unit_2', 'target_3 as target_unit_3', 'target_4 as target_unit_4', 'target_5 as target_unit_5', 'target_6 as target_unit_6', 'target_7 as target_unit_7', 'target_8 as target_unit_8', 'target_9 as target_unit_9', 'target_10 as target_unit_10', 'target_11 as target_unit_11', 'target_12 as target_unit_12')
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
        Actual::create([
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
            'record_name' => $request->record_name,
            'record_file' => isset($recordFileName) ? $recordFileName : null,
            'department_name' => $request->department_name,
            'kpi_weighting' => $request->kpi_weighting,
            'date' => $date,
            'employee_id' => $request->employee_id,

        ]);

        return redirect()->route('actual.show', ['id' => $request->employee_id])
            ->with('success', 'Data Realisasi berhasil ditambahkan');
    }
}
