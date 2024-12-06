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
                'nik' => '222-014',
                'name' => 'Yuda Aldeika',
                'occupation' => 'Asst Mng',
                'department_id' => 1
            ],
            [
                'nik' => '211-001',
                'name' => 'Abdul Gani',
                'occupation' => 'Adm A',
                'department_id' => 1
            ],
            [
                'nik' => '219-032',
                'name' => 'Ridwan Nugroho',
                'occupation' => 'Adm A',
                'department_id' => 1
            ],
            [
                'nik' => '218-038',
                'name' => 'Muhammad Hamdi',
                'occupation' => 'Spv',
                'department_id' => 3
            ],
            [
                'nik' => '200-137',
                'name' => 'Edy Sujatmoko',
                'occupation' => 'Asst Mng',
                'department_id' => 2
            ],
            [
                'nik' => '218-047',
                'name' => 'Rudi Yurianto, STP.',
                'occupation' => 'Asst Mng',
                'department_id' => 4
            ]
        ];

        foreach ($employees as $employee) {
            Employee::factory()->create($employee);
        }
    }
}
