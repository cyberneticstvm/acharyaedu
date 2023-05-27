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
        Schema::table('subjects', function(Blueprint $table){
            $table->unsignedBigInteger('exam_type')->references('id')->on('exam_types')->after('name')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function(Blueprint $table){
            $table->dropColumn('exam_type');
        });
    }
};
