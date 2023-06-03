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
        Schema::create('download_modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('download_id');
            $table->unsignedBigInteger('module_id')->references('id')->on('modules');
            $table->foreign('download_id')->references('id')->on('downloads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_modules');
    }
};
