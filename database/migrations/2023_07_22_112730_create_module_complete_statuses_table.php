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
        Schema::create('module_complete_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('batch');
            $table->unsignedBigInteger('module');
            $table->unsignedBigInteger('faculty')->references('id')->on('faculties')->default(0);
            $table->boolean('status')->comment('1-completed, 0-pending')->default(0);
            $table->unsignedBigInteger('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
            $table->foreign('module')->references('id')->on('topics');
            $table->foreign('batch')->references('id')->on('batches');
            $table->unique(['module', 'batch']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_complete_statuses');
    }
};
