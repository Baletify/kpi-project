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
                'code' => 'BSKP.910-619.01',
                'indicator' => 'Ketersediaan kontener',
                'calculation' => 'Ketersediaan kontener dihitung dari jumlah kontener yang tersedia untuk target pengiriman berdasarkan planning shipment untuk bulan berkenaan',
                'period' => 'Monthly',
                'unit' => 'Freq',
                'supporting_document' => 'Actual shipment',
                'weighting' => '12%',
                'trend' => 'Positif',
                'employee_id' => 7,
                'date' => '2024-01-08 01:49:17',
                'detail' => 'Jumlah kontener ynag diperlukan akan disampaikan ke pihak pelayaran untuk disiapkan sesuai dengan tanggal rencana pengiriman dan keprluan kontener',
                'target_unit_id' => 6,
            ],
            [
                'code' => 'BSKP.910-619.02',
                'indicator' => 'Membuat forecast pengiriman untuk diajukan ke top management',
                'calculation' => 'Forecast pengiriman dihitung dari sisa inventory RSS bulan sebelumnya ditambahkan dengan perkiraan produksi bulan ini',
                'period' => 'Monthly',
                'unit' => '%',
                'supporting_document' => 'Forecast shipment',
                'weighting' => '20%',
                'trend' => 'Positif',
                'employee_id' => 7,
                'date' => '2024-01-08 01:49:17',
                'detail' => 'Forecast shipment harus di ajukan pada minggu pertama setiap bulan untuk rencana pengiriman bulan berikutnya',
                'target_unit_id' => 7,
            ],
            [
                'code' => 'BSKP.910-619.03',
                'indicator' => 'Pengiriman dokumen dan penagihan ke buyers',
                'calculation' => 'Penagihan dilakukan dengan menerbitkan master invoice yaitu gabungan dari beberapa invoice untuk dilakukan pembayaran oeh pihak buyer',
                'period' => 'Quarter',
                'unit' => '%',
                'supporting_document' => 'Master Invoice',
                'weighting' => '13%',
                'trend' => 'Positif',
                'employee_id' => 7,
                'date' => '2024-01-08 01:49:17',
                'detail' => 'Penagihan dilakukan dengan mengirimkan master invoice kepada buyer',
                'target_unit_id' => 8,
            ],
            [
                'code' => 'BSKP.910-619.04',
                'indicator' => 'Membuat schedule pengiriman',
                'calculation' => 'Schedule pengiriman di buat setelah diterbitkannya PO oleh BSSG yang berisikan nomor kontrak yang selanjutnya disetor kepabrik selambatnya tanggal 25 untuk pengiriman bulan berikutnya',
                'period' => 'Monthly',
                'unit' => 'Freq',
                'supporting_document' => 'Outstanding contract and planning shipment',
                'weighting' => '10%',
                'trend' => 'Positif',
                'employee_id' => 7,
                'date' => '2024-01-08 01:49:17',
                'detail' => 'Schedule shipment harus disiapkan dan didistribusikan ke pabrik dan pelayaran yang ditunjuk semester',
                'target_unit_id' => 9,
            ],
            [
                'code' => 'BSKP.910-619.05',
                'indicator' => 'Komplen pelanggan',
                'calculation' => 'Dihitung seberapa banyak pelanggan melakukan komplen atas barang dan pelayanan, target komplen zero  "0"',
                'period' => 'Anually',
                'trend' => 'Negatif',
                'unit' => 'Freq',
                'supporting_document' => 'Data komplen pelanggan',
                'weighting' => '20%',
                'employee_id' => 7,
                'date' => '2024-01-08 01:49:17',
                'detail' => 'Dilakukan setiap tahun',
                'target_unit_id' => 10,
            ],
        ];

        foreach ($targets as $target) {
            Target::factory()->create($target);
        }
    }
}
