<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('takes', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->date('enroll_date');
            $table->string('grade', 2)->nullable();
            $table->enum('status', ['ongoing', 'completed', 'dropped'])->default('ongoing');
            $table->decimal('attendance', 5, 2)->nullable();
            $table->timestamps();

            $table->primary(['student_id', 'course_id']);
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('takes');
    }
};
