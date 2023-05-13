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
        Schema::create('free_exams', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->unique();
            $table->unsignedBigInteger('batch_id')->default(0)->nullable();
            $table->integer('cut_off_mark')->default(0);
            $table->integer('question_count')->default(0);
            $table->dateTime('exam_date');
            $table->integer('duration')->comment('Duration in minutes')->default(1)->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->unsignedBigInteger('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_exams');
    }
};
