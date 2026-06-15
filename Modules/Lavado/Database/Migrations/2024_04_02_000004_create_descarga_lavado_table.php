<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescargaLavadoTable extends Migration
{
    public function up()
    {
        Schema::create('descarga_lavado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lavado_id');
            $table->string('reference');
            $table->string('operator');
            $table->string('equipo')->nullable();
            $table->string('lote')->nullable();
            $table->string('programa_lavado')->nullable();
            $table->decimal('temperatura', 5, 1)->nullable();
            $table->string('status_ciclo')->default('Pendiente'); // Pendiente / Cargar / Ciclo Correcto / Ciclo con Falla
            $table->string('status_indicador')->default('Sin Validar');       // Pendiente / Registrado
            $table->string('status')->nullable();                  // Registrado / Procesado
            $table->text('note')->nullable();
            $table->foreign('lavado_id')->references('id')->on('lavados')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('descarga_lavado');
        Schema::enableForeignKeyConstraints();
    }
}
