<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TargetUnit;

class TargetUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetUnits = [

            // HSE YUDA START
            // KPI 1
            [
                'target_1' => null,
                'target_2' => null,
                'target_3' => null,
                'target_4' => null,
                'target_5' => null,
                'target_6' => null,
                'target_7' => null,
                'target_8' => null,
                'target_9' => null,
                'target_10' => null,
                'target_11' => null,
                'target_12' => '1'
            ],
            // KPI 2
            [
                'target_1' => null,
                'target_2' => null,
                'target_3' => '1',
                'target_4' => null,
                'target_5' => null,
                'target_6' => '1',
                'target_7' => null,
                'target_8' => null,
                'target_9' => '1',
                'target_10' => null,
                'target_11' => null,
                'target_12' => '1'
            ],
            // KPI 3
            [
                'target_1' => '1',
                'target_2' => '1',
                'target_3' => '1',
                'target_4' => '1',
                'target_5' => '1',
                'target_6' => '1',
                'target_7' => '1',
                'target_8' => '1',
                'target_9' => '1',
                'target_10' => '1',
                'target_11' => '1',
                'target_12' => '1'
            ],
            // KPI 4
            [
                'target_1' => null,
                'target_2' => null,
                'target_3' => null,
                'target_4' => null,
                'target_5' => null,
                'target_6' => '1',
                'target_7' => null,
                'target_8' => null,
                'target_9' => null,
                'target_10' => null,
                'target_11' => null,
                'target_12' => '1'
            ],
            // KPI 5
            [
                'target_1' => null,
                'target_2' => null,
                'target_3' => '1',
                'target_4' => null,
                'target_5' => null,
                'target_6' => '1',
                'target_7' => null,
                'target_8' => null,
                'target_9' => '1',
                'target_10' => null,
                'target_11' => null,
                'target_12' => '1'
            ],

            // HSE YUDA END

            // HSE GANI START
            // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '100%',
            //     'target_3' => '100%',
            //     'target_4' => '100%',
            //     'target_5' => '100%',
            //     'target_6' => '100%',
            //     'target_7' => '100%',
            //     'target_8' => '100%',
            //     'target_9' => '100%',
            //     'target_10' => '100%',
            //     'target_11' => '100%',
            //     'target_12' => '100%'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '1',
            //     'target_3' => '1',
            //     'target_4' => '1',
            //     'target_5' => '1',
            //     'target_6' => '1',
            //     'target_7' => '1',
            //     'target_8' => '1',
            //     'target_9' => '1',
            //     'target_10' => '1',
            //     'target_11' => '1',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => ''
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '1',
            //     'target_3' => '1',
            //     'target_4' => '1',
            //     'target_5' => '1',
            //     'target_6' => '1',
            //     'target_7' => '1',
            //     'target_8' => '1',
            //     'target_9' => '1',
            //     'target_10' => '1',
            //     'target_11' => '1',
            //     'target_12' => '1'
            // ],
            // // HSE GANI END

            // // HSE RIDWAN START
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '37',
            //     'target_3' => '40',
            //     'target_4' => '70',
            //     'target_5' => '60',
            //     'target_6' => '100',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => ''
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '1',
            //     'target_3' => '',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '',
            //     'target_7' => '',
            //     'target_8' => '1',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => ''
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '1',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '1',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '1',
            //     'target_3' => '1',
            //     'target_4' => '1',
            //     'target_5' => '1',
            //     'target_6' => '1',
            //     'target_7' => '1',
            //     'target_8' => '1',
            //     'target_9' => '1',
            //     'target_10' => '1',
            //     'target_11' => '1',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '1',
            //     'target_3' => '1',
            //     'target_4' => '1',
            //     'target_5' => '1',
            //     'target_6' => '1',
            //     'target_7' => '1',
            //     'target_8' => '1',
            //     'target_9' => '1',
            //     'target_10' => '1',
            //     'target_11' => '1',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '1',
            //     'target_3' => '1',
            //     'target_4' => '1',
            //     'target_5' => '1',
            //     'target_6' => '1',
            //     'target_7' => '1',
            //     'target_8' => '1',
            //     'target_9' => '1',
            //     'target_10' => '1',
            //     'target_11' => '1',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '1',
            //     'target_3' => '1',
            //     'target_4' => '1',
            //     'target_5' => '1',
            //     'target_6' => '1',
            //     'target_7' => '1',
            //     'target_8' => '1',
            //     'target_9' => '1',
            //     'target_10' => '1',
            //     'target_11' => '1',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '1',
            //     'target_2' => '1',
            //     'target_3' => '1',
            //     'target_4' => '1',
            //     'target_5' => '1',
            //     'target_6' => '1',
            //     'target_7' => '1',
            //     'target_8' => '1',
            //     'target_9' => '1',
            //     'target_10' => '1',
            //     'target_11' => '1',
            //     'target_12' => '1'
            // ],
            // // KPI
            // [
            //     'target_1' => '',
            //     'target_2' => '',
            //     'target_3' => '',
            //     'target_4' => '',
            //     'target_5' => '',
            //     'target_6' => '1',
            //     'target_7' => '',
            //     'target_8' => '',
            //     'target_9' => '',
            //     'target_10' => '',
            //     'target_11' => '',
            //     'target_12' => ''
            // ],
            // HSE RIDWAN END

        ];

        foreach ($targetUnits as $targetUnit) {
            TargetUnit::factory()->create($targetUnit);
        }
    }
}
