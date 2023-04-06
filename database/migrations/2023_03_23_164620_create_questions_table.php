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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->longText('question')->nullable();
            $table->unsignedBigInteger('subject_id')->references('id')->on('subjects');
            $table->integer('correct_option')->default(0);
            $table->boolean('available_for_free')->comment('1-yes, 0-no')->default(0);
            $table->boolean('status')->comment('1-active, 0-inactive')->default(1);
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
        Schema::dropIfExists('questions');
    }
};
