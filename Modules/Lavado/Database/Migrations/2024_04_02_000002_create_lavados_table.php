<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLavadosTable extends Migration
{
    public function up()
    {
        Schema::create('lavados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reception_id')->nullable();
            $table->string('reference');
            $table->string('operator');
            $table->string('equipo')->nullable();           // Nombre del equipo lavadora
            $table->string('lote')->nullable();             // Lote del ciclo
            $table->string('programa_lavado')->nullable();  // Programa utilizado
            $table->decimal('temperatura', 5, 1)->nullable(); // Temperatura en °C
            $table->string('status_indicador')->default('Sin Validar'); // Sin Validar / Correcto / Falla
            $table->string('status_ciclo')->default('Pendiente'); // Pendiente / Cargar / Ciclo Correcto / Ciclo con Falla
            $table->text('note')->nullable();
            $table->foreign('reception_id')->references('id')->on('receptions')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('lavados');
        Schema::enableForeignKeyConstraints();
    }
}
