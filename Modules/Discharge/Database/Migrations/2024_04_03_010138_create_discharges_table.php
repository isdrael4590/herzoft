<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('discharges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('labelqr_id');
            $table->string('reference');
            $table->string('machine_name');
            $table->string('machine_type');
            $table->string('lote_machine');
            $table->string('temp_machine');
            $table->string('type_program');
            $table->string('lote_biologic');
            $table->string('validation_biologic')->nullable();
            $table->string('temp_ambiente');
            $table->string('status_cycle')->nullable();
            $table->string('ruta_process')->nullable();
            $table->text('note')->nullable();
            $table->string('operator');
            $table->foreign('labelqr_id')->references('id')->on('labelqrs')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discharges');
    }
};
