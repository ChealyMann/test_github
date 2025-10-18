<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Positions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departmentIds = Department::pluck('department_id')->toArray();
        $positionIds = Positions::pluck('position_id')->toArray();

        return [
            'full_name' => fake()->name(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'dob' => fake()->date(),
            'national_id' => fake()->unique()->numerify('##########'),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'hire_date' => fake()->date(),
            'department_id' => fake()->randomElement($departmentIds),
            'position_id' => fake()->randomElement($positionIds),
            'employee_type' => fake()->randomElement(['Full-time', 'Part-time', 'Contract']),
            'status' => fake()->randomElement(['active', 'resigned']),
            'profile_photo' => 'https://via.placeholder.com/150',
        ];
    }
}