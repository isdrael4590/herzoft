<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;

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

       Product::create([
        'category_id' => '1',
            'product_name' => 'ABRE-BOCA + CAJA DE FRESAS',
            'product_code'  => 'V1',
            'area'  => 'Odontologia',
            'product_unit'  => 'Un',
            'product_quantity'  => '1',
            'product_type_process' => 'Alta Temperatura',
            'product_barcode_symbology' => 'C128'
        ]
        );
      
   
        
    }
}
