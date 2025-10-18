<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'department_code' => 'HR',
                'department_name' => 'Human Resources',
                'description' => 'Handles employee relations, recruitment, and benefits.',
                'status' => 'active',
            ],
            [
                'department_code' => 'IT',
                'department_name' => 'Information Technology',
                'description' => 'Manages the company\'s technology infrastructure.',
                'status' => 'active',
            ],
            [
                'department_code' => 'FIN',
                'department_name' => 'Finance',
                'description' => 'Manages the company\'s finances.',
                'status' => 'active',
            ],
            [
                'department_code' => 'MKT',
                'department_name' => 'Marketing',
                'description' => 'Promotes the company and its products.',
                'status' => 'active',
            ],
            [
                'department_code' => 'SAL',
                'department_name' => 'Sales',
                'description' => 'Sells the company\'s products and services.',
                'status' => 'active',
            ],
        ]);
    }
}