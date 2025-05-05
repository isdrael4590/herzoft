<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetestbdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testbds', function (Blueprint $table) {
            $table->id();
            $table->string('testbd_reference');
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->string('machine_name');
            $table->string('lote_machine');
            $table->string('temp_machine');
            $table->string('lote_bd');
            $table->string('validation_bd')->nullable();
            $table->string('temp_ambiente');
            $table->string('operator')->nullable();;
            $table->string('observation')->nullable();;
            $table->foreign('machine_id')->references('id')->on('machines')->nullOnDelete();
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
        Schema::dropIfExists('testbds');
    }
}
