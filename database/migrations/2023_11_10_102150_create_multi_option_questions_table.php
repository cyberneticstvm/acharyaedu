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
        Schema::create('multi_option_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->longText('question')->nullable();
            $table->longText('option_a')->nullable();
            $table->longText('option_b')->nullable();
            $table->longText('option_c')->nullable();
            $table->longText('option_d')->nullable();
            $table->longText('explanation')->nullable();
            $table->char('correct_option', 1)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multi_option_questions');
    }
};
