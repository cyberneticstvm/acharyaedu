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
        Schema::create('student_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id')->references('id')->on('exams');
            $table->unsignedBigInteger('student_id')->references('id')->on('students');
            $table->integer('correct_answer_count')->default(0);
            $table->integer('wrong_answer_count')->default(0);
            $table->decimal('total_mark', 5, 2)->default(0.00);
            $table->decimal('cutoff_mark', 5, 2)->default(0.00);
            $table->decimal('total_mark_after_cutoff', 5, 2)->default(0.00);
            $table->integer('grade')->default(0);
            $table->unique(['exam_id', 'student_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exams');
    }
};
