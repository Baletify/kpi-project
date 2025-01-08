<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GeneratePdfController extends Controller
{
    public function generatePdfInput(Request $request)
    {
        $nik = Auth::user()->nik;
        $email = Auth::user()->email;

        $userNames = DB::table('employees')->where('email', '=', $email)->pluck('name')->toArray();

        $userNameString = implode(' / ', $userNames);

        // dd($userNameString);
        $departmentID = Auth::user()->department_id;

        $employee = DB::table('employees')->select('id')->where('nik', '=', $nik)->first();

        $actual = DB::table('actuals')->select('input_at')->where('employee_id', '=', $employee->id)->orderBy('input_at', 'desc')->first();



        $actualDept = DB::table('department_actuals')->select('input_at')->where('department_id', '=', $departmentID)->orderBy('input_at', 'desc')->first();

        $actualTimestamp = $actual ? strtotime($actual->input_at) : 0;
        $actualDeptTimestamp = $actualDept ? strtotime($actualDept->input_at) : 0;
        $newestTimestamp = $actualTimestamp > $actualDeptTimestamp ? $actualTimestamp : $actualDeptTimestamp;

        $last_input = date('d M Y H:i:s', $newestTimestamp);
        $tteNumber = date('His', $newestTimestamp) . '/' . date('m', $newestTimestamp) . '/' . date('Y', $newestTimestamp);


        $dept = Department::where('id', $request->department_id)->first();
        $data = [
            'title' => 'TANDA TERIMA ELEKTRONIK',
            'sub_1' => 'PELAPORAN DATA KEY PERFORMANCE INDICATOR (KPI)',
            'sub_2' => 'PT BRIDGESTONE KALIMANTAN PLANTATION',
            'no_tte' => $tteNumber,
            'last_input' => $last_input,
            'created_at' => now()->format('d M Y H:i:s'),
            'department' => $dept->name,
            'nik' => $nik,
            'name' => $userNameString,
            'desc_1' => 'Dokumen ini sah, diterbitkan secara elektronik melalui aplikasi KPI di PT Bridgestone Kalimantan Plantation sehingga tidak memerlukan cap dan tanda tangan.',
            'desc_2' => 'Terima kasih telah menyampaikan laporan KPI. ',
            'signature' => 'Manajemen BSKP'
        ];

        // dd($data);

        $pdf = Pdf::loadView('generate-pdf-input', $data)->setPaper('a5', 'landscape');

        return $pdf->download('TTE-Input-' . now()->format('d-M-Y') . '.pdf');
    }

    public function generatePdfCheck(Request $request)
    {
        $nik = Auth::user()->nik;
        $email = Auth::user()->email;

        $userNames = DB::table('employees')->where('email', '=', $email)->pluck('name')->toArray();

        $userNameString = implode(' / ', $userNames);

        // dd($userNameString);
        $departmentID = Auth::user()->department_id;

        $employee = DB::table('employees')->select('id')->where('nik', '=', $nik)->first();

        $actual = DB::table('actuals')->select('input_at')->where('employee_id', '=', $employee->id)->orderBy('input_at', 'desc')->first();

        $actualDept = DB::table('department_actuals')->select('input_at')->where('department_id', '=', $departmentID)->orderBy('input_at', 'desc')->first();

        $actualTimestamp = $actual ? strtotime($actual->input_at) : 0;
        $actualDeptTimestamp = $actualDept ? strtotime($actualDept->input_at) : 0;
        $newestTimestamp = $actualTimestamp > $actualDeptTimestamp ? $actualTimestamp : $actualDeptTimestamp;

        $last_input = date('d M Y H:i:s', $newestTimestamp);
        $tteNumber = date('His', $newestTimestamp) . '/' . date('m', $newestTimestamp) . '/' . date('Y', $newestTimestamp);

        $dept = Department::where('id', $request->department_id)->first();
        $data = [
            'title' => 'TANDA TERIMA ELEKTRONIK',
            'sub_1' => 'PELAPORAN DATA KEY PERFORMANCE INDICATOR (KPI)',
            'sub_2' => 'PT BRIDGESTONE KALIMANTAN PLANTATION',
            'no_tte' => $tteNumber,
            'last_input' => $last_input,
            'created_at' => now()->format('d M Y H:i:s'),
            'department' => $dept->name,
            'nik' => $nik,
            'name' => $userNameString,
            'desc_1' => 'Dokumen ini sah, diterbitkan secara elektronik melalui aplikasi KPI di PT Bridgestone Kalimantan Plantation sehingga tidak memerlukan cap dan tanda tangan.',
            'desc_2' => 'Terima kasih telah menyampaikan laporan KPI. ',
            'signature' => 'Manajemen BSKP'
        ];

        // dd($data);

        $pdf = Pdf::loadView('generate-pdf-check', $data)->setPaper('a5', 'landscape');

        return $pdf->download('TTE-check-' . now()->format('d-M-Y') . '.pdf');
    }
}
