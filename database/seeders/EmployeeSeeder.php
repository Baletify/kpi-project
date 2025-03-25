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
            // [
            //     'nik' => '222-014',
            //     'name' => 'Yuda Aldeika',
            //     'occupation' => 'Asst Mng',
            //     'department_id' => 1
            // ],
            // [
            //     'nik' => '211-001',
            //     'name' => 'Abdul Gani',
            //     'occupation' => 'Adm A',
            //     'department_id' => 1
            // ],
            // [
            //     'nik' => '219-032',
            //     'name' => 'Ridwan Nugroho',
            //     'occupation' => 'Adm A',
            //     'department_id' => 1
            // ],
            // [
            //     'nik' => '218-038',
            //     'name' => 'Muhammad Hamdi',
            //     'occupation' => 'Spv',
            //     'department_id' => 3
            // ],
            // [
            //     'nik' => '200-137',
            //     'name' => 'Edy Sujatmoko',
            //     'occupation' => 'Asst Mng',
            //     'department_id' => 2
            // ],
            // [
            //     'nik' => '218-047',
            //     'name' => 'Rudi Yurianto, STP.',
            //     'occupation' => 'Asst Mng',
            //     'department_id' => 4
            // ]

            [
                'nik' => '123-123',
                'name' => 'Agus Wijaya',
                'status' => 'Monthly',
                'email' => 'sirrr.carrot@gmail.com',
                'password' => bcrypt('password'),
                'occupation' => 'Clerk',
                'input_type' => 'Group',
                'role' => 'Inputer',
                'is_active' => 1,
                'department_id' => 3
            ],
            [
                'nik' => '111-111',
                'name' => 'Heri Kurniawan',
                'status' => 'Monthly',
                'email' => 'asst@example.com',
                'password' => bcrypt('password'),
                'occupation' => 'Clerk',
                'input_type' => 'Individual',
                'role' => 'Checker 1',
                'is_active' => 1,
                'department_id' => 3
            ],
            [
                'nik' => '299-111',
                'name' => 'Marsudi',
                'status' => 'Monthly',
                'email' => 'div1clerk@example.com',
                'password' => bcrypt('password'),
                'occupation' => 'Div 1 Clerk',
                'input_type' => 'Individual',
                'role' => 'Checker 2',
                'is_active' => 1,
                'department_id' => 5
            ],
            [
                'nik' => '999-999',
                'name' => 'Haris Purnomo',
                'status' => 'Mng',
                'email' => 'div1mng@example.com',
                'password' => bcrypt('password'),
                'occupation' => 'Div 1 Manager',
                'input_type' => 'Individual',
                'role' => 'Mng Approver',
                'is_active' => 1,
                'department_id' => 1
            ],
            [
                'nik' => '000-111',
                'name' => 'Ruri Sinaga',
                'status' => 'Monthly',
                'email' => 'hrd@example.com',
                'password' => bcrypt('password'),
                'occupation' => 'Spv',
                'input_type' => 'Individual',
                'role' => 'Approver',
                'is_active' => 1,
                'department_id' => 2
            ]

        ];

        foreach ($employees as $employee) {
            Employee::factory()->create($employee);
        }
    }
}
