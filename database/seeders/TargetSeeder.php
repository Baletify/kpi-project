<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Target;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targets = [
            [
                'code' => 'IT.917-849.01',
                'indicator' => 'Jumlah fitur aplikasi yang diselesaikan',
                'calculation' => '5 fitur per bulan',
                'period' => 'Monthly',
                'unit' => 'Freq',
                'supporting_document' => 'Log pengerjaan fitur',
                'weighting' => '12%',
                'trend' => 'Positif',
                'employee_id' => 1,
                'detail' => '5 fitur per bulan',
                'target_unit_id' => 1,
            ],
            [
                'code' => 'IT.917-849.02',
                'indicator' => 'Tingkat Penyelesaian Fitur Tepat Waktu',
                'calculation' => '90% Tepat Waktu',
                'period' => 'Monthly',
                'unit' => '%',
                'supporting_document' => 'Log pengerjaan fitur',
                'weighting' => '20%',
                'trend' => 'Positif',
                'employee_id' => 1,
                'detail' => '90% Tepat Waktu',
                'target_unit_id' => 2,
            ],
            [
                'code' => 'IT.917-849.03',
                'indicator' => 'Tingkat Penyelesaian Error Tepat Waktu',
                'calculation' => '90% Tepat Waktu',
                'period' => 'Monthly',
                'unit' => '%',
                'supporting_document' => 'Log pengerjaan fitur',
                'weighting' => '13%',
                'trend' => 'Positif',
                'employee_id' => 1,
                'detail' => '90% Tepat Waktu',
                'target_unit_id' => 3,
            ],
            [
                'code' => 'IT.917-849.04',
                'indicator' => 'Inovasi',
                'calculation' => 'Inovasi Produk',
                'period' => 'Tentative',
                'unit' => 'Freq',
                'supporting_document' => 'Form Sururaku',
                'weighting' => '10%',
                'trend' => 'Positif',
                'employee_id' => 1,
                'detail' => 'Setidaknya ada 1 inovasi yang diajukan per semester',
                'target_unit_id' => 4,
            ],
            [
                'code' => 'IT.917-849.05',
                'indicator' => 'Action Plan',
                'calculation' => 'Action Plan',
                'period' => 'Monthly',
                'trend' => 'Positif',
                'unit' => 'Freq',
                'supporting_document' => 'Form Action Plan',
                'weighting' => '20%',
                'employee_id' => 1,
                'detail' => 'Pembuatan rencana & update kegiatan pengembangan software',
                'target_unit_id' => 5,
            ],
        ];

        foreach ($targets as $target) {
            Target::factory()->create($target);
        }
    }
}
