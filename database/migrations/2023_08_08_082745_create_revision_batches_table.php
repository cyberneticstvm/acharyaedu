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
        Schema::create('revision_batches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('revision_id');
            $table->unsignedBigInteger('batch_id')->references('id')->on('batches')->default(0)->nullable();
            $table->foreign('revision_id')->references('id')->on('revisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision_batches');
    }
};
