<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Category;
use Modules\Setting\Entities\Unit;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Category::create([
            'category_code' => 'CA_01',
            'category_name' => 'LAPARASCOPIA'
        ]);

        Unit::create([
            'name' => 'Unidad',
            'short_name' => 'Un',
     
        ]);
    }
}
