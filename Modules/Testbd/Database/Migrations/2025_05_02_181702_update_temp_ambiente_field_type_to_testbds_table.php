<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class UpdateTempAmbienteFieldType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testbds', function (Blueprint $table) {
            $table->string('temp_ambiente')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testbds', function (Blueprint $table) {
            $table->integer('temp_ambiente')->change();
        });
    }
};