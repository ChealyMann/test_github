<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('full_name')->uniqid();
            $table->enum('gender',['active','inactive'])->default('active');
            $table->date('dob');
            $table->string('national_id')->uniqid();
            $table->string('email')->uniqid();
            $table->string('phone_number')->uniqid();
            $table->text('address');
            $table->date('hire_date');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('position_id');
            $table->enum('employee_type',['Full-time','Part-item','Contract']);
            $table->enum('status',['active','resigned']);
            $table->string('profile_photo');
            $table->timestamps();

              // Foreign key constraint
            $table->foreign('department_id')
                  ->references('department_id')
                  ->on('departments')
                  ->onDelete('cascade');
            $table->foreign('position_id')
                  ->references('position_id')
                  ->on('positions')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
