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
        Schema::create('preparations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reception_id');
            $table->string('reference');
            $table->string('operator');
            $table->text('note')->nullable();
            $table->foreign('reception_id')->references('id')->on('receptions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**SSS
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preparations');
    }
};