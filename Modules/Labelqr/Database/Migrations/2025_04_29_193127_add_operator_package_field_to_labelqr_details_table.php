<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperatorPackageFieldToLabelqrDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('labelqr_details', function (Blueprint $table) {
             $table->string('product_operator_package')->nullable()->after('product_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labelqr_details', function (Blueprint $table) {
            $table->dropColumn('product_operator_package');
            
        });
    }
};
