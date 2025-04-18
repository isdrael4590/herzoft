<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDischargeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharge_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discharge_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('labelqr_detail_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->integer('price');
            $table->integer('unit_price');
            $table->integer('sub_total');
            $table->string('product_package_wrap');
            $table->string('product_outside_company')->nullable();
            $table->string('product_area')->nullable();
            $table->string('product_patient')->nullable();
            $table->string('product_info')->nullable();
            $table->string('product_ref_qr')->nullable();
            $table->string('product_eval_package')->nullable();
            $table->string('product_eval_indicator')->nullable();
            $table->string('product_expiration')->nullable();
            $table->string('product_type_process')->nullable();
            $table->foreign('discharge_id')->references('id')->on('discharges')->onDelete('cascade');
            $table->foreign('labelqr_detail_id')->references('id')->on('labelqr_details')->onDelete('cascade');
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
        Schema::dropIfExists('discharge_details');
    }
}
