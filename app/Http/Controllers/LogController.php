<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $semester = ($currentMonth <= 6) ? '1' : '2';

        if ($semester === '1') {
            $months = range(1, 6); // January to June
        } else {
            $months = range(7, 12); // July to December
        }

        $departments = DB::table('actuals')
            ->select('department_name', 'created_at')
            ->whereIn('id', function ($query) use ($months) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('actuals')
                    ->whereIn(DB::raw('MONTH(created_at)'), $months)
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
