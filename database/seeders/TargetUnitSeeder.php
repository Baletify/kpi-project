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
            [
                'target_1' => '4',
                'target_2' => '4',
                'target_3' => '4',
                'target_4' => '4',
                'target_5' => '4',
                'target_6' => '4',
                'target_7' => '4',
                'target_8' => '4',
                'target_9' => '4',
                'target_10' => '4',
                'target_11' => '4',
                'target_12' => '4'
            ],
            [
                'target_1' => '85%',
                'target_2' => '85%',
                'target_3' => '85%',
                'target_4' => '85%',
                'target_5' => '85%',
                'target_6' => '85%',
                'target_7' => '85%',
                'target_8' => '85%',
                'target_9' => '85%',
                'target_10' => '85%',
                'target_11' => '85%',
                'target_12' => '85%'
            ],
            [
                'target_1' => '85%',
                'target_2' => '85%',
                'target_3' => '85%',
                'target_4' => '85%',
                'target_5' => '85%',
                'target_6' => '85%',
                'target_7' => '85%',
                'target_8' => '85%',
                'target_9' => '85%',
                'target_10' => '85%',
                'target_11' => '85%',
                'target_12' => '85%'
            ],
            [
                'target_1' => '300.000',
                'target_2' => '300.000',
                'target_3' => '300.000',
                'target_4' => '300.000',
                'target_5' => '300.000',
                'target_6' => '300.000',
                'target_7' => '300.000',
                'target_8' => '300.000',
                'target_9' => '300.000',
                'target_10' => '300.000',
                'target_11' => '300.000',
                'target_12' => '300.000'
            ],
            [
                'target_1' => '6',
                'target_2' => '6',
                'target_3' => '6',
                'target_4' => '6',
                'target_5' => '6',
                'target_6' => '6',
                'target_7' => '6',
                'target_8' => '6',
                'target_9' => '6',
                'target_10' => '6',
                'target_11' => '6',
                'target_12' => '6'
            ],
        ];

        foreach ($targetUnits as $targetUnit) {
            TargetUnit::factory()->create($targetUnit);
        }
    }
}
