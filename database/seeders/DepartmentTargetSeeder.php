<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartmentTarget;

class DepartmentTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targets = [
            [
                'code' => 'IT.01',
                'indicator' => 'Jumlah fitur aplikasi yang diselesaikan',
                'calculation' => '5 fitur per bulan',
                'period' => 'Monthly',
                'unit' => 'Freq',
                'supporting_document' => 'Log pengerjaan fitur',
                'weighting' => '12%',
                'department_id' => 3,
                'detail' => '5 fitur per bulan',
                'target_unit_id' => 1,
            ],
            [
                'code' => 'IT.02',
                'indicator' => 'Tingkat Penyelesaian Fitur Tepat Waktu',
                'calculation' => '90% Tepat Waktu',
                'period' => 'Monthly',
                'unit' => '%',
                'supporting_document' => 'Log pengerjaan fitur',
                'weighting' => '20%',
                'department_id' => 3,
                'detail' => '5 fitur per bulan',
                'target_unit_id' => 2,
            ],
            [
                'code' => 'IT.03',
                'indicator' => 'Tingkat Penyelesaian Error Tepat Waktu',
                'calculation' => '90% Tepat Waktu',
                'period' => 'Monthly',
                'unit' => '%',
                'supporting_document' => 'Log pengerjaan fitur',
                'weighting' => '13%',
                'department_id' => 3,
                'target_unit_id' => 3,
            ],
            [
                'code' => 'IT.04',
                'indicator' => 'Inovasi',
                'calculation' => 'Inovasi Produk',
                'period' => 'Tentative',
                'unit' => 'Freq',
                'supporting_document' => 'Form Sururaku',
                'weighting' => '10%',
                'department_id' => 3,
                'detail' => 'Setidaknya ada 1 inovasi yang diajukan per semester',
                'target_unit_id' => 4,
            ],
            [
                'code' => 'IT.05',
                'indicator' => 'Action Plan',
                'calculation' => 'Action Plan',
                'period' => 'Monthly',
                'unit' => 'Freq',
                'supporting_document' => 'Form Action Plan',
                'weighting' => '20%',
                'department_id' => 3,
                'detail' => 'Pembuatan rencana & update kegiatan pengembangan software',
                'target_unit_id' => 5,
            ],
        ];

        foreach ($targets as $target) {
            DepartmentTarget::factory()->create($target);
        }
    }
}
