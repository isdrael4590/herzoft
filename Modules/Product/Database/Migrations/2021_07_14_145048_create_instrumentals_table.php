<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumentals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();

            $table->string('codigo_unico_ud')->unique()->nullable();
            $table->string('nombre_generico')->nullable();
            $table->string('tipo_familia')->nullable();
            $table->string('marca_fabricante')->nullable();
            $table->date('fecha_compra')->nullable();
            $table->string('estado_actual')->default('DISPONIBLE'); // DISPONIBLE, EN_USO, MANTENIMIENTO, BAJA
            $table->foreign('product_id')->references('id')
                ->on('products')->nullOnDelete();
            $table->timestamps();
            $table->index('codigo_unico_ud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_products');
    }
}
