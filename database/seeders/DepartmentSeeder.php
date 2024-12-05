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
                'name' => 'Safety',
                'code' => 'HSE',
            ],
            [
                'name' => 'Sales & Purchasing',
                'code' => 'SPID',
            ],
            [
                'name' => 'HRD/Legal',
                'code' => 'HRD',
            ],
        ];

        foreach ($departments as $department) {
            Department::factory()->create($department);
        }
    }
}
