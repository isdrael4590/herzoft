<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Institutes', function (Blueprint $table) {
            $table->id();
            $table->string('institute_code')->unique();
            $table->string('institute_name');
            $table->string('institute_address');
            $table->string('institute_area');
            $table->string('institute_city');
            $table->string('institute_country');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Institutes');
    }
}
