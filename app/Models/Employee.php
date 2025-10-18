<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';   
    protected $primaryKey = 'employee_id';
    public $timestamps = true; // if you use created_at/updated_at

    protected $fillable = [
        'full_name',
        'gender',
        'dob',
        'national_id',
        'email',
        'phone_number',
        'address',
        'hire_date',
        'department_id',
        'position_id',
        'employee_type',
        'status',
        'profile_photo',
    ];

    // Department relation
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'department_id');
    }

    // Position relation
    public function position()
    {
        return $this->belongsTo(Positions::class, 'position_id', 'position_id');
    }
}
