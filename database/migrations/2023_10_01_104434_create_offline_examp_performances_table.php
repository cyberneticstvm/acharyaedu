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
        Schema::create('offline_examp_performances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->string('exam_name')->nullable();
            $table->date('exam_date')->nullable();
            $table->integer('total_mark')->default(0);
            $table->decimal('mark_scored')->default(0.00);
            $table->decimal('performance')->comment('30% Below Average, 40% Average, 50% Above Average, 60% Good, 75% Excellent')->default(0.00);
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offline_examp_performances');
    }
};
