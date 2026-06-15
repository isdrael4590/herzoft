<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('preparations', 'lavado_id')) {
            return;
        }

        Schema::table('preparations', function (Blueprint $table) {
            $table->unsignedBigInteger('lavado_id')->nullable()->after('reception_id');
            $table->foreign('lavado_id')->references('id')->on('lavados')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('preparations', function (Blueprint $table) {
            $table->dropForeign(['lavado_id']);
            $table->dropColumn('lavado_id');
        });
    }
};
