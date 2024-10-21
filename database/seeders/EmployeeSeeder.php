<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'nik' => fake()->unique()->randomNumber(6),
                'name' => fake()->name(),
                'occupation' => 'BSKP Staff',
                'department_id' => 1
            ],
            [
                'nik' => fake()->unique()->randomNumber(6),
                'name' => fake()->name(),
                'occupation' => 'Enviro Staff',
                'department_id' => 2
            ],
            [
                'nik' => fake()->unique()->randomNumber(6),
                'name' => fake()->name(),
                'occupation' => 'IT Staff',
                'department_id' => 3
            ],
        ];

        foreach ($employees as $employee) {
            Employee::factory()->create($employee);
        }
    }
}
