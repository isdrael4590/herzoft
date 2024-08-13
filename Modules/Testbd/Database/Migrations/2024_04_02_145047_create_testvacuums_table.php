<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetestvacuumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testvacuums', function (Blueprint $table) {
            $table->id();
            $table->string('testvacuum_reference');
            $table->unsignedBigInteger('machine_id')->nullable();
            $table->string('machine_name');
            $table->string('lote_machine');
            $table->string('tipo_equipo');
            $table->integer('temp_ambiente');
            $table->string('validation_vacuum')->nullable();
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
        Schema::dropIfExists('testvacuums');
    }
}
