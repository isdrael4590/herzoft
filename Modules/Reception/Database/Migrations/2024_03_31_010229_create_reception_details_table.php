<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('reception_id');
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
            $table->string('product_type_dirt');
            $table->string('product_state_rumed')->nullable();
            $table->string('product_type_process')->nullable();
            $table->foreign('reception_id')->references('id')->on('receptions')->onDelete('cascade');
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

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('reception_details');
        Schema::enableForeignKeyConstraints();
    }
}
