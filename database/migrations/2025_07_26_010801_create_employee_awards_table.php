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
         Schema::create('employee_awards', function (Blueprint $table) {
            $table->id('award_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('award_title');
            $table->string('award_type');
            $table->date('award_date');
            $table->text('reason')->nullable();
            $table->decimal('value', 10, 2)->default(0);
            $table->string('given_by');
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employees')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_awards');
    }
};
