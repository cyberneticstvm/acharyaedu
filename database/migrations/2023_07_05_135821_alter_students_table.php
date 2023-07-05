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
        Schema::table('students', function(Blueprint $table){
            $table->decimal('admission_fee_advance', 7, 2)->after('fee')->default(0)->nullable();
            $table->decimal('admission_fee_balance', 7, 2)->after('admission_fee_advance')->default(0)->nullable();
            $table->unsignedBigInteger('payment_mode')->after('admission_fee_balance')->references('id')->on('payment_modes')->nullable();            
            $table->date('tentative_date')->after('payment_mode')->nullable();
            $table->boolean('balance_received')->after('tentative_date')->comment('1-Yes, 0-No')->default(0);
            $table->text('remarks')->after('balance_received')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function(Blueprint $table){
            $table->dropColumn(['admission_fee_advance', 'admission_fee_balance', 'payment_mode', 'tentative_date', 'balance_received', 'remarks']);
        });
    }
};
