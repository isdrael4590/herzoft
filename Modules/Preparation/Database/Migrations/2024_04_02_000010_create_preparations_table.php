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
        if (Schema::hasTable('preparations')) {
            return;
        }

        Schema::create('preparations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reception_id')->nullable();
            $table->unsignedBigInteger('lavado_id')->nullable();
            $table->string('reference');
            $table->string('operator');
            $table->text('note')->nullable();
            $table->integer('total_amount');
            $table->foreign('reception_id')->references('id')->on('receptions')->nullOnDelete();
            $table->foreign('lavado_id')->references('id')->on('lavados')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**SSS
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('preparations');
        Schema::enableForeignKeyConstraints();
    }
};
