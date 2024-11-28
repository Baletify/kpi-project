<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $semester = ($currentMonth < 7) ? '1' : '2';
        $year = $request->query('year');

        if ($semester === '1') {
            $months = range(1, 6); // January to June
        } else {
            $months = range(7, 12); // July to December
        }

        $departments = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('departments.code as department_code', 'actuals.created_at', 'departments.id as department_id')
            ->whereIn('actuals.id', function ($query) use ($months) {
                $query->select(DB::raw('MAX(actuals.id)'))
                    ->from('actuals')
                    ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                    ->join('departments', 'employees.department_id', '=', 'departments.id')
                    ->whereIn(DB::raw('MONTH(actuals.created_at)'), $months)
                    ->groupBy('departments.code', DB::raw('MONTH(actuals.created_at), departments.id'));
            })
            ->whereIn(DB::raw('MONTH(actuals.created_at)'), $months)
            ->orderBy('actuals.created_at', 'desc')
            ->get()
            ->groupBy('department_code')
            ->map(function ($items) {
                return collect($items);
            });

        $targetCounts = DB::table('targets')
            ->leftJoin('employees', 'targets.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->where(DB::raw('YEAR(targets.date)'), $year)
            ->select('departments.code as code', DB::raw('count(targets.id) as total'))
            ->groupBy('departments.code')
            ->get();

        $targetUnitCounts1 = DB::table('target_units')
            ->leftJoin('targets', 'target_units.id', '=', 'targets.target_unit_id')
            ->leftJoin('employees', 'targets.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->whereYear('targets.date', $year)
            // ->whereNotNull('target_units.id')
            ->select(
                'departments.code as department_code',
                DB::raw('count(target_units.target_1) as total_1'),
                DB::raw('count(target_units.target_2) as total_2'),
                DB::raw('count(target_units.target_3) as total_3'),
                DB::raw('count(target_units.target_4) as total_4'),
                DB::raw('count(target_units.target_5) as total_5'),
                DB::raw('count(target_units.target_6) as total_6'),
            )
            ->groupBy('departments.code')
            ->get();

        $targetUnitCounts2 = DB::table('target_units')
            ->leftJoin('targets', 'target_units.id', '=', 'targets.target_unit_id')
            ->leftJoin('employees', 'targets.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->whereYear('targets.date', $year)
            // ->whereNotNull('target_units.id')
            ->select(
                'departments.code as department_code',
                DB::raw('count(target_units.target_7) as total_7'),
                DB::raw('count(target_units.target_8) as total_8'),
                DB::raw('count(target_units.target_9) as total_9'),
                DB::raw('count(target_units.target_10) as total_10'),
                DB::raw('count(target_units.target_11) as total_11'),
                DB::raw('count(target_units.target_12) as total_12')
            )
            ->groupBy('departments.code')
            ->get();


        $actualCounts = DB::table('actuals')
            ->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->select('departments.code as department_code', DB::raw('MONTH(actuals.date) as month'), DB::raw('count(actuals.status) as total'),)->where('actuals.status', 'Approved')
            ->where(DB::raw('YEAR(actuals.date)'), $year)
            ->whereIn(DB::raw('MONTH(actuals.date)'), $months)->groupBy('departments.code', DB::raw('MONTH(actuals.date)'))
            ->get()
            ->map(function ($item) {
                return (array) $item;
            });

        // dd($actualCounts);


        return view('log-check', [
            'title' => 'Log Input',
            'desc' => 'History',
            'departments' => $departments,
            'months' => $months,
            'semester' => $semester,
            'targetCounts' => $targetCounts,
            'actualCounts' => $actualCounts,
            'targetUnitCounts1' => $targetUnitCounts1,
            'targetUnitCounts2' => $targetUnitCounts2

        ]);
    }

    public function indexInput(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $semester = ($currentMonth <= 6) ? 'ganjil' : 'genap';
        if ($semester === 'ganjil') {
            $months = range(1, 6); // January to June
        } else {
            $months = range(7, 12); // July to December
        }

        $year = $request->query('year');

        $departments = DB::table('actuals')
            ->select('department_name', 'created_at')
            ->whereIn('id', function ($query) use ($months, $year) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('actuals')
                    ->whereIn(DB::raw('MONTH(created_at)'), $months)
                    ->where(DB::raw('YEAR(created_at)'), $year)
                    ->groupBy('department_name', DB::raw('MONTH(created_at)'));
            })
            ->whereIn(DB::raw('MONTH(created_at)'), $months)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('department_name')
            ->map(function ($items) {
                return collect($items);
            });

        return view('log-input', [
            'title' => 'Log Input',
            'desc' => 'History',
            'departments' => $departments,
            'months' => $months,
            'semester' => $semester
        ]);
    }
}
