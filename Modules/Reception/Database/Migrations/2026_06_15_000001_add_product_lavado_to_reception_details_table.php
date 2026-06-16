
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductLavadoToReceptionDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('reception_details', function (Blueprint $table) {
            if (!Schema::hasColumn('reception_details', 'product_lavado')) {
                $table->boolean('product_lavado')->default(false)->after('product_type_process');
            }
        });
    }

    public function down()
    {
        Schema::table('reception_details', function (Blueprint $table) {
            $table->dropColumn('product_lavado');
        });
    }
}

