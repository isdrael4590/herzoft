<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateexpeditionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedition_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('expedition_id');
            $table->unsignedBigInteger('stock_detail_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->integer('price');
            $table->integer('unit_price');
            $table->integer('sub_total');
            $table->string('product_patient')->nullable();
            $table->string('product_info')->nullable();
            $table->string('product_outside_company')->nullable();
            $table->string('product_area')->nullable();
            $table->string('product_package_wrap');
            $table->string('product_ref_qr')->nullable();
            $table->string('product_expiration');
            $table->string('product_type_process')->nullable();
            $table->foreign('expedition_id')->references('id')->on('expeditions')->onDelete('cascade');
            $table->foreign('stock_detail_id')->references('id')->on('stock_details')->cascadeOnDelete();
            //$table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expedition_details');
    }
}
