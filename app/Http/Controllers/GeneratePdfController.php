<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GeneratePdfController extends Controller
{
    public function generatePdfInput(Request $request)
    {

        $dept = Department::where('id', $request->department_id)->first();
        $data = [
            'title' => 'TANDA TERIMA ELEKTRONIK',
            'sub_1' => 'PELAPORAN DATA KEY PERFORMANCE INDICATOR (KPI)',
            'sub_2' => 'PT BRIDGESTONE KALIMANTAN PLANTATION',
            'no_tte' => 'XXXX-1234',
            'last_input' => $request->input_at,
            'created_at' => now()->format('d M Y'),
            'department' => $dept->name,
            'nik' => 'XXX-123',
            'name' => 'Mr. Z',
            'desc_1' => 'Dokumen ini sah, diterbitkan secara elektronik melalui aplikasi KPI di PT Bridgestone Kalimantan Plantation sehingga tidak memerlukan cap dan tanda tangan',
            'desc_2' => 'Terima kasih telah menyampaikan laporan KPI',
            'signature' => 'Manajemen BSKP'
        ];

        $pdf = Pdf::loadView('generatePdfInput', $data);

        return $pdf->download('TTE-Input-' . now()->format('d-M-Y') . '.pdf');
    }
}
