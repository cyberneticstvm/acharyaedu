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
        Schema::create('exam_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125)->unique();
            $table->unsignedBigInteger('batch_id');
            $table->integer('cut_off_mark')->default(0);
            $table->integer('question_count')->default(0);
            $table->dateTime('exam_duration')->default(0);
            $table->string('status', 25)->default('Active');
            $table->foreign('batch_id')->references('id')->on('batches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_types');
    }
};
