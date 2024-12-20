<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class GeneratePdfController extends Controller
{
    public function generatePdfInput(Request $request)
    {
        $input_at = Carbon::parse($request->input_at);

        $dept = Department::where('id', $request->department_id)->first();
        $data = [
            'title' => 'TANDA TERIMA ELEKTRONIK',
            'sub_1' => 'PELAPORAN DATA KEY PERFORMANCE INDICATOR (KPI)',
            'sub_2' => 'PT BRIDGESTONE KALIMANTAN PLANTATION',
            'no_tte' => 'XXXX-1234',
            'last_input' => $input_at->format('d M Y H:i:s'),
            'created_at' => now()->format('d M Y H:i:s'),
            'department' => $dept->name,
            'nik' => 'XXX-123',
            'name' => $request->input_by,
            'desc_1' => 'Dokumen ini sah, diterbitkan secara elektronik melalui aplikasi KPI di PT Bridgestone Kalimantan Plantation sehingga tidak memerlukan cap dan tanda tangan.',
            'desc_2' => 'Terima kasih telah menyampaikan laporan KPI. ',
            'signature' => 'Manajemen BSKP'
        ];

        // dd($data);

        $pdf = Pdf::loadView('generate-pdf-input', $data)->setPaper('a5', 'landscape');

        return $pdf->download('TTE-Input-' . now()->format('d-M-Y') . '.pdf');
    }
}
