<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageScholarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_scholars', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 50)->unique(); // Specify length for student_id
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('middle_name', 100)->nullable(); // Allow null values
            $table->string('course', 100);
            $table->integer('year_level');
            $table->string('scholarship_type');
            $table->decimal('gpa', 4, 2)->nullable(); // GPA precision for academic scholars
            $table->string('category', 50)->nullable(); // Allow null values for category
            $table->timestamps(); // Automatically manages created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_scholars');
    }
}
