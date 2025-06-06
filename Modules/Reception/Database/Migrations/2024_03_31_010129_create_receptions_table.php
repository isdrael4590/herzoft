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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->string('operator');
            $table->string('delivery_staff')->nullable();
            $table->string('area');
            $table->integer('total_amount');
            $table->string('status');
            $table->text('note')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('receptions');
        Schema::enableForeignKeyConstraints();
    }
};
