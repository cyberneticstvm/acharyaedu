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
        Schema::table('exams', function(Blueprint $table){
            $table->unsignedBigInteger('exam_type')->after('id')->references('id')->on('exam_types')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function(Blueprint $table){
            $table->dropColumn('exam_type');
        });
    }
};
