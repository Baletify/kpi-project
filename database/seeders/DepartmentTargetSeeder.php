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
                'code' => 'IT.810-997.01',
                'indicator' => 'Jumlah fitur aplikasi yang diselesaikan',
                'calculation' => '5 fitur per bulan',
                'period' => 'Monthly',
                'unit' => 'Freq',
                'supporting_document' => 'IMG-2024-10-16-070645',
                'weighting' => '12%',
                'department_id' => 2,
                'target_unit_id' => 1,
            ],
            [
                'code' => 'IT.810-997.02',
                'indicator' => 'Tingkat Penyelesaian Fitur Tepat Waktu',
                'calculation' => '90% Tepat Waktu',
                'period' => 'Monthly',
                'unit' => '%',
                'supporting_document' => 'IMG-2024-10-16-070915',
                'weighting' => '20%',
                'department_id' => 2,
                'target_unit_id' => 2,
            ],
            [
                'code' => 'IT.810-997.03',
                'indicator' => 'Tingkat Penyelesaian Error Tepat Waktu',
                'calculation' => '90% Tepat Waktu',
                'period' => 'Monthly',
                'unit' => '%',
                'supporting_document' => 'IMG-2024-10-16-071145',
                'weighting' => '13%',
                'department_id' => 2,
                'target_unit_id' => 3,
            ],
        ];

        foreach ($targets as $target) {
            DepartmentTarget::factory()->create($target);
        }
    }
}