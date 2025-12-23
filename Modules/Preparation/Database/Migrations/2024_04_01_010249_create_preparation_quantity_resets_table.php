<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('preparation_quantity_resets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preparation_detail_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('previous_quantity');
            $table->integer('new_quantity')->default(0);
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_area')->nullable();
            $table->string('product_type_process')->nullable();
            $table->timestamp('reset_at');
            $table->timestamps();

            $table->foreign('preparation_detail_id')
                  ->references('id')
                  ->on('preparation_details')
                  ->onDelete('cascade');
                  
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('preparation_quantity_resets');
    }
};