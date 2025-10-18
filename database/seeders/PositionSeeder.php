<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentIds = Department::pluck('department_id')->toArray();

        DB::table('positions')->insert([
            [
                'position_title' => 'HR Manager',
                'description' => 'Manages the HR department.',
                'level' => 'Manager',
                'department_id' => $departmentIds[0],
                'is_managerial' => true,
            ],
            [
                'position_title' => 'IT Specialist',
                'description' => 'Provides IT support.',
                'level' => 'Specialist',
                'department_id' => $departmentIds[1],
                'is_managerial' => false,
            ],
            [
                'position_title' => 'Financial Analyst',
                'description' => 'Analyzes financial data.',
                'level' => 'Analyst',
                'department_id' => $departmentIds[2],
                'is_managerial' => false,
            ],
            [
                'position_title' => 'Marketing Manager',
                'description' => 'Manages marketing campaigns.',
                'level' => 'Manager',
                'department_id' => $departmentIds[3],
                'is_managerial' => true,
            ],
            [
                'position_title' => 'Sales Manager',
                'description' => 'Manages the sales team.',
                'level' => 'Manager',
                'department_id' => $departmentIds[4],
                'is_managerial' => true,
            ],
        ]);
    }
}