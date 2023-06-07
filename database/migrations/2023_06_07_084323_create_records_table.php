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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id')->references('id')->on('subjects');
            $table->string('title')->nullable();
            $table->string('video_id')->nullable();
            $table->text('description')->nullable();            
            $table->text('category', 10)->comment('free/paid')->nullable();            
            $table->text('type', 10)->comment('recorded/zoom-live/other')->nullable();            
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
        Schema::dropIfExists('records');
    }
};
