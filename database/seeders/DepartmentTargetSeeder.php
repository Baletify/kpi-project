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
            // [
            //     'code' => 'HSE.01',
            //     'indicator' => 'Comply with regulation about safety and DP',
            //     'calculation' => 'Jumlah regulasi yang sudah di evaluasi : jumlah regulasi yang sudah taat',
            //     'supporting_document' => 'Analisa Regulasi dan Action Plan perbaikan',
            //     'period' => 'Annual',
            //     'unit' => '%',
            //     'weighting' => '10%',
            //     'trend' => 'Positif',
            //     'department_id' => 7,
            //     'date' => '2024-01-08 01:49:17',
            //     'detail' => 'Persentasi ketaatan terhadap peraturan yang berkaitan dengan K3',
            //     'target_unit_id' => 1,
            // ],
            // [
            //     'code' => 'HSE.02',
            //     'indicator' => 'Comply terhadap standard BSJ (Zen-Z-Zai, Safety global std, IMD stndard)',
            //     'calculation' => 'Standard BSJ yang belum taat (comply) dilakukan perbaikan',
            //     'supporting_document' => 'Evaluasi standard BSJ',
            //     'period' => 'Quarter',
            //     'unit' => 'Freq',
            //     'weighting' => '10%',
            //     'trend' => 'Positif',
            //     'department_id' => 7,
            //     'date' => '2024-01-08 01:49:17',
            //     'detail' => 'Persentasi ketaatan terhadap peraturan yang berkaitan dengan K3',
            //     'target_unit_id' => 2,
            // ],
            // [
            //     'code' => 'HSE.03',
            //     'indicator' => 'Comply terhadap peraturan KLHK tentang Karhutla',
            //     'calculation' => 'Daftar peralatan KARHUTLA yang terdapat dalam regulasi dilakukan perbaikan',
            //     'supporting_document' => 'Analisa Regulasi',
            //     'period' => 'Monthly',
            //     'unit' => '%',
            //     'weighting' => '10%',
            //     'trend' => 'Positif',
            //     'department_id' => 7,
            //     'date' => '2024-01-08 01:49:17',
            //     'detail' => 'Permentan No. 05 th 2028 Pembukaan dan / atau pengolahan lahan perkebunan tanpa membakar',
            //     'target_unit_id' => 3,
            // ],
            // [
            //     'code' => 'HSE.04',
            //     'indicator' => 'Area hotwork sesuai standard',
            //     'calculation' => 'Perbandingan antara standard  Hot work vs Actual ',
            //     'supporting_document' => 'Perbandingan antara standard  Hot work vs Actual',
            //     'period' => 'Semester',
            //     'unit' => '%',
            //     'weighting' => '10%',
            //     'trend' => 'Positif',
            //     'department_id' => 7,
            //     'date' => '2024-01-08 01:49:17',
            //     'detail' => '',
            //     'target_unit_id' => 4,
            // ],
            // [
            //     'code' => 'HSE.05',
            //     'indicator' => 'P2K3',
            //     'calculation' => 'Kegiatan meeting P3K3 dan Laporan P2K3 ke Pemerintah',
            //     'supporting_document' => 'Notulen meeting P3K3, Absensi dan Laporan ke pemerintah',
            //     'period' => 'Quarter',
            //     'unit' => 'Freq/ th',
            //     'weighting' => '10%',
            //     'trend' => 'Positif',
            //     'department_id' => 7,
            //     'date' => '2024-01-08 01:49:17',
            //     'detail' => 'Kegiatan Sekretariat P2K3',
            //     'target_unit_id' => 5,
            // ],
            [
                'code' => 'DIVD.01',
                'indicator' => 'P2K3',
                'calculation' => 'Kegiatan meeting P3K3 dan Laporan P2K3 ke Pemerintah',
                'supporting_document' => 'Notulen meeting P3K3, Absensi dan Laporan ke pemerintah',
                'period' => 'Quarter',
                'unit' => 'Freq/ th',
                'weighting' => '10%',
                'trend' => 'Positif',
                'department_id' => 16,
                'date' => '2024-01-08 01:49:17',
                'detail' => 'Kegiatan Sekretariat P2K3',
                'target_unit_id' => 4,
            ],
            [
                'code' => 'DIVE.01',
                'indicator' => 'P2K3',
                'calculation' => 'Kegiatan meeting P3K3 dan Laporan P2K3 ke Pemerintah',
                'supporting_document' => 'Notulen meeting P3K3, Absensi dan Laporan ke pemerintah',
                'period' => 'Quarter',
                'unit' => 'Freq/ th',
                'weighting' => '10%',
                'trend' => 'Positif',
                'department_id' => 17,
                'date' => '2024-01-08 01:49:17',
                'detail' => 'Kegiatan Sekretariat P2K3',
                'target_unit_id' => 5,
            ],
            // [
            //     'code' => 'DIVF.01',
            //     'indicator' => 'P2K3',
            //     'calculation' => 'Kegiatan meeting P3K3 dan Laporan P2K3 ke Pemerintah',
            //     'supporting_document' => 'Notulen meeting P3K3, Absensi dan Laporan ke pemerintah',
            //     'period' => 'Quarter',
            //     'unit' => 'Freq/ th',
            //     'weighting' => '10%',
            //     'trend' => 'Positif',
            //     'department_id' => 18,
            //     'date' => '2024-01-08 01:49:17',
            //     'detail' => 'Kegiatan Sekretariat P2K3',
            //     'target_unit_id' => 3,
            // ],
        ];

        foreach ($targets as $target) {
            DepartmentTarget::factory()->create($target);
        }
    }
}
