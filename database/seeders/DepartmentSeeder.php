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
                'name' => 'Enviro',
                'code' => 'ENV',
            ],
            [
                'name' => 'IT',
                'code' => 'IT',
            ],
        ];

        foreach ($departments as $department) {
            Department::factory()->create($department);
        }
    }
}
