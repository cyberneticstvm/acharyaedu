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
        Schema::create('offline_exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('batch_id');
            $table->integer('total_mark')->default(0);
            $table->integer('cut_off_mark')->default(0);
            $table->integer('question_count')->default(0);
            $table->integer('duration')->default(1);
            $table->date('exam_date');
            $table->boolean('status')->comment('1-Active, 2-Inactive')->default(1);
            $table->unique(['name', 'batch_id', 'exam_date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offline_exams');
    }
};
