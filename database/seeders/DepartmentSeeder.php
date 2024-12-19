<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'BSKP',
                'code' => 'BSKP',
            ],
            [
                'name' => 'Supply Chain, Procurement, Inventory, and Distribution',
                'code' => 'SPID',
            ],
            [
                'name' => 'HR Legal',
                'code' => 'HRD',
            ],
            [
                'name' => 'Acc & Finance',
                'code' => 'ACC',
            ],
            [
                'name' => 'IT',
                'code' => 'IT',
            ],
            [
                'name' => 'Safety',
                'code' => 'HSE',
            ],
            [
                'name' => 'Enviro',
                'code' => 'ENV',
            ],
            [
                'name' => 'QA/QM',
                'code' => 'QA',
            ],
            [
                'name' => 'Factory',
                'code' => 'FAC',
            ],
            [
                'name' => 'FAD/FSD',
                'code' => 'FAD',
            ],
            [
                'name' => 'Sub Div A',
                'code' => 'DIVA',
            ],
            [
                'name' => 'Sub Div B',
                'code' => 'DIVB',
            ],
            [
                'name' => 'Sub Div C',
                'code' => 'DIVC',
            ],
            [
                'name' => 'Sub Div D',
                'code' => 'DIVD',
            ],
            [
                'name' => 'Sub Div E',
                'code' => 'DIVE',
            ],
            [
                'name' => 'Sub Div F',
                'code' => 'DIVF',
            ],
            [
                'name' => 'Security',
                'code' => 'SEC',
            ],
            [
                'name' => 'Workshop',
                'code' => 'WSD',
            ],

        ];

        foreach ($departments as $department) {
            Department::factory()->create($department);
        }
    }
}
