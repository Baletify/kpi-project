<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Month;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            [
                'month_1' => 'Jan',
                'month_2' => 'Feb',
                'month_3' => 'Mar',
                'month_4' => 'Apr',
                'month_5' => 'May',
                'month_6' => 'Jun',
                'month_7' => 'Jul',
                'month_8' => 'Aug',
                'month_9' => 'Sep',
                'month_10' => 'Oct',
                'month_11' => 'Nov',
                'month_12' => 'Dec',
            ],
        ];

        foreach ($months as $month) {
            Month::factory()->create($month);
        }
    }
}
