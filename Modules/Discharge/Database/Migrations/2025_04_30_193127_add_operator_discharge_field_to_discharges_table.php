<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperatorDischargeFieldToDischargesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('discharges', function (Blueprint $table) {
             $table->string('operator_discharge')->nullable()->after('operator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discharges', function (Blueprint $table) {
            $table->dropColumn('operator_discharge');
            
        });
    }
};
