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
        Schema::table('fees', function(Blueprint $table){
            $table->decimal('fee_advance', 7, 2)->after('fee')->default(0)->nullable();
            $table->decimal('fee_balance', 7, 2)->after('fee_advance')->default(0)->nullable();
            $table->unsignedBigInteger('payment_mode')->after('fee_balance')->references('id')->on('payment_modes')->nullable();            
            $table->date('tentative_date')->after('payment_mode')->nullable();
            $table->text('remarks')->after('tentative_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fees', function(Blueprint $table){
            $table->dropColumn(['fee_advance', 'fee_balance', 'payment_mode', 'tentative_date', 'remarks']);
        });
    }
};
