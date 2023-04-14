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
        Schema::create('student_exam_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_exam_id');
            $table->unsignedBigInteger('question_id')->references('id')->on('questions');
            $table->unsignedBigInteger('subject_id')->references('id')->on('subjects');
            $table->smallInteger('correct_option');
            $table->smallInteger('selected_option');
            $table->boolean('answer')->comment('1-correct, 0-wrong, null-not attended')->nullable();
            $table->foreign('student_exam_id')->references('id')->on('student_exams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_scores');
    }
};
