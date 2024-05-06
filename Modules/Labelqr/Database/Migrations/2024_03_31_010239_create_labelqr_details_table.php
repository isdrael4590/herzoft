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
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('labelqr_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_package_wrap');
            $table->string('product_ref_qr')->nullable();
            $table->string('product_eval_package')->nullable();
            $table->string('product_eval_indicator')->nullable();
            $table->foreign('labelqr_id')->references('id')->on('labelqrs')->onDelete('cascade');
            $table->foreign('product_id')->references('id')
                ->on('products')->nullOnDelete();
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
