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
        $semester = ($currentMonth <= 6) ? '1' : '2';
        $year = $request->query('year');

        if ($semester === '1') {
            $months = range(1, 6); // January to June
        } else {
            $months = range(7, 12); // July to December
        }

        $departments = DB::table('actuals')
            ->join('employees', 'actuals.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select('departments.code as department_code', 'actuals.created_at')
            ->whereIn('actuals.id', function ($query) use ($months) {
                $query->select(DB::raw('MAX(actuals.id)'))
                    ->from('actuals')
                    ->join('employees', 'actuals.employee_id', '=', 'employees.id')
                    ->join('departments', 'employees.department_id', '=', 'departments.id')
                    ->whereIn(DB::raw('MONTH(actuals.created_at)'), $months)
                    ->groupBy('departments.code', DB::raw('MONTH(actuals.created_at)'));
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


        $actualCounts = DB::table('actuals')
            ->leftJoin('employees', 'employees.id', '=', 'actuals.employee_id')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->select('departments.code as department_code', DB::raw('MONTH(actuals.date) as month'), DB::raw('count(actuals.status) as total'),)->where('actuals.status', 'Terisi')
            ->where(DB::raw('YEAR(actuals.date)'), $year)
            ->where(DB::raw('MONTH(actuals.date)'), $months)->groupBy('departments.code', 'actuals.date')
            ->get()
            ->map(function ($item) {
                return (array) $item;
            });

        return view('log-input', [
            'title' => 'Log Input',
            'desc' => 'History',
            'departments' => $departments,
            'months' => $months,
            'semester' => $semester,
            'targetCounts' => $targetCounts,
            'actualCounts' => $actualCounts,
        ]);
    }
}
