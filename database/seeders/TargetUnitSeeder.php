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
                'target_1' => '5',
                'target_2' => '5',
                'target_3' => '5',
                'target_4' => '5',
                'target_5' => '5',
                'target_6' => '5',
                'target_7' => '5',
                'target_8' => '5',
                'target_9' => '5',
                'target_10' => '5',
                'target_11' => '5',
                'target_12' => '5'
            ],
            [
                'target_1' => '90%',
                'target_2' => '90%',
                'target_3' => '90%',
                'target_4' => '90%',
                'target_5' => '90%',
                'target_6' => '90%',
                'target_7' => '90%',
                'target_8' => '90%',
                'target_9' => '90%',
                'target_10' => '90%',
                'target_11' => '90%',
                'target_12' => '90%'
            ],
            [
                'target_1' => '90%',
                'target_2' => '90%',
                'target_3' => '90%',
                'target_4' => '90%',
                'target_5' => '90%',
                'target_6' => '90%',
                'target_7' => '90%',
                'target_8' => '90%',
                'target_9' => '90%',
                'target_10' => '90%',
                'target_11' => '90%',
                'target_12' => '90%'
            ],
            [
                'target_1' => '5',
                'target_2' => '5',
                'target_3' => '5',
                'target_4' => '5',
                'target_5' => '5',
                'target_6' => '5',
                'target_7' => '5',
                'target_8' => '5',
                'target_9' => '5',
                'target_10' => '5',
                'target_11' => '5',
                'target_12' => '5'
            ],
            [
                'target_1' => '5',
                'target_2' => '5',
                'target_3' => '5',
                'target_4' => '5',
                'target_5' => '5',
                'target_6' => '5',
                'target_7' => '5',
                'target_8' => '5',
                'target_9' => '5',
                'target_10' => '5',
                'target_11' => '5',
                'target_12' => '5'
            ],
        ];

        foreach ($targetUnits as $targetUnit) {
            TargetUnit::factory()->create($targetUnit);
        }
    }
}
