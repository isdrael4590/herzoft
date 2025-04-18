<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelqrDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labelqr_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('labelqr_id');
            $table->unsignedBigInteger('preparation_detail_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->integer('product_quantity_fail')->nullable();
            $table->integer('price');
            $table->integer('unit_price');
            $table->integer('sub_total');
            $table->string('product_package_wrap');
            $table->string('product_patient')->nullable();
            $table->string('product_info')->nullable();
            $table->string('product_outside_company')->nullable();
            $table->string('product_area')->nullable();
            $table->string('product_ref_qr')->nullable();
            $table->string('product_eval_package')->nullable();
            $table->string('product_eval_indicator')->nullable();
            $table->string('product_expiration')->nullable();
            $table->string('product_type_process')->nullable();
            $table->foreign('labelqr_id')->references('id')->on('labelqrs')->onDelete('cascade');
            $table->foreign('preparation_detail_id')->references('id')->on('preparation_details')->cascadeOnDelete();

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
        Schema::dropIfExists('labelqr_details');
    }
}
