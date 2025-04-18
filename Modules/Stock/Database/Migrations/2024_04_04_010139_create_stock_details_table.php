<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->integer('product_quantity_expedition')->nullable();
            $table->integer('price');
            $table->integer('unit_price');
            $table->integer('sub_total');
            $table->string('product_area')->nullable();
            $table->string('product_patient')->nullable();
            $table->string('product_info')->nullable();
            $table->string('product_outside_company')->nullable();
            $table->string('product_package_wrap');
            $table->string('product_ref_qr')->nullable();
            $table->string('product_status_stock')->nullable();
            $table->timestamp('product_date_sterilized');
            $table->timestamp('product_expiration')->nullable();
            $table->string('product_type_process')->nullable();
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_details');
    }
};
