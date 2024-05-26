<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreparationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('preparation_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_state_preparation')->nullable();
            $table->string('product_coming_zone')->nullable();
            $table->string('product_type_process')->nullable();
            $table->foreign('preparation_id')->references('id')->on('preparations')->onDelete('cascade');
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
        Schema::dropIfExists('preparation_details');
    }
}
