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
        Schema::create('student_offline_exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('correct_answer_count')->default(0)->nullable();
            $table->integer('wrong_answer_count')->default(0)->nullable();
            $table->integer('unattended_count')->default(0)->nullable();
            $table->decimal('total_mark', 5, 2)->default(0.00);
            $table->decimal('cutoff_mark', 5, 2)->default(0.00);
            $table->decimal('total_mark_after_cutoff', 5, 2)->default(0.00)->nullable();
            $table->integer('grade')->default(0)->nullable();
            $table->unique(['exam_id', 'student_id']);
            $table->foreign('exam_id')->references('id')->on('offline_exams')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_offline_exams');
    }
};
