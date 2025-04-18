<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\Product;

class ProductImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {



        foreach ($rows as $row) {

            $Category_id = Category::where("category_name", $row['area'])->get()->first();
            Product::create([
                'category_id' => $Category_id->id,
                'product_name' => $row['product_name'],
                'product_code' => $row['product_code'],
                'product_barcode_symbology' => $row['product_barcode_symbology'],
                'product_type_process' => $row['product_type_process'],
                'area' => $row['area'],
                'product_unit' => $row['product_unit'],
                'product_note' => $row['product_note'],
                'product_price' => $row['product_price'],
                'product_info' => $row['product_info'],
                'product_quantity' => $row['product_quantity'],
                'product_patient' => $row['product_patient'],
            ]);
        }
    }
}
