<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescargaLavadoDetallesTable extends Migration
{
    public function up()
    {
        Schema::create('descarga_lavado_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('descarga_lavado_id');
            $table->unsignedBigInteger('lavado_detalle_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->string('product_patient')->nullable();
            $table->string('product_info')->nullable();
            $table->string('product_outside_company')->nullable();
            $table->string('product_area')->nullable();
            $table->string('product_type_process')->nullable();
            $table->foreign('descarga_lavado_id')->references('id')->on('descarga_lavado')->cascadeOnDelete();
            $table->foreign('lavado_detalle_id')->references('id')->on('lavado_detalles')->nullOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('descarga_lavado_detalles');
        Schema::enableForeignKeyConstraints();
    }
}
