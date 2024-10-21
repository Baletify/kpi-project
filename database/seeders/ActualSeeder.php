<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actual;

class ActualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $actuals = [
            [
                'kpi_code' => 'IT.715-807.01',
                'kpi_item' => 'Jumlah fitur aplikasi yang diselesaikan',
                'kpi_unit' => 'Freq',
                'review_period' => 'Monthly',
                'program_number' => 'PR.715-807.01',
                'program_file' => 'PR.715-807.01.pdf',
                'target' => '5',
                'actual' => '5',
                'kpi_calculation' => '5 fitur per bulan',
                'supporting_document' => 'IMG-2024-10-16-070645',
                'comment' => 'OK',
                'record_name' => 'Log pengerjaan aplikasi',
                'record_file' => 'Log-2024-10-16-070645.pdf',
                'month' => '2024-01-01',
                'department_name' => 'IT',
                'kpi_weighting' => '12%',
                'employee_id' => 3,
            ],
            [
                'kpi_code' => 'IT.715-807.02',
                'kpi_item' => 'Tingkat Penyelesaian Fitur Tepat Waktu',
                'kpi_unit' => '%',
                'review_period' => 'Monthly',
                'program_number' => 'PR.715-807.02',
                'program_file' => 'PR.715-807.02.pdf',
                'target' => '90%',
                'actual' => '95%',
                'kpi_calculation' => '90% Tepat Waktu',
                'supporting_document' => 'IMG-2024-10-16-070645',
                'comment' => 'OK',
                'record_name' => 'Log pengerjaan aplikasi',
                'record_file' => 'Log-2024-10-16-090645.pdf',
                'month' => '2024-01-01',
                'department_name' => 'IT',
                'kpi_weighting' => '20%',
                'employee_id' => 3,
            ],
            [
                'kpi_code' => 'IT.715-807.03',
                'kpi_item' => 'Tingkat Penyelesaian Error Tepat Waktu',
                'kpi_unit' => '%',
                'review_period' => 'Monthly',
                'program_number' => 'PR.715-807.03',
                'program_file' => 'PR.715-807.03.pdf',
                'target' => '90%',
                'actual' => '95%',
                'kpi_calculation' => '90% Tepat Waktu',
                'supporting_document' => 'IMG-2024-10-16-081645',
                'comment' => 'OK',
                'record_name' => 'Log pengerjaan aplikasi',
                'record_file' => 'Log-2024-10-16-090645.pdf',
                'month' => '2024-01-01',
                'department_name' => 'IT',
                'kpi_weighting' => '13%',
                'employee_id' => 3,
            ],
        ];

        foreach ($actuals as $actual) {
            Actual::factory()->create($actual);
        }
    }
}
