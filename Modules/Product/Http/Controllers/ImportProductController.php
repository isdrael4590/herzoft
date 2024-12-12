<?php

namespace Modules\Product\Http\Controllers;

use App\Imports\CategoryImport;
use App\Imports\ProductImport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Product\Entities\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\Requests\StoreProductRequest;

class ImportProductController extends Controller
{



    public function create()
    {
        abort_if(Gate::denies('create_importproducts'), 403);

        return view('product::ImportProducts.create');
    }


    public function store(Request $request)
    {

        $FileProduct = $request->file('file');
        Excel::import(new ProductImport, $FileProduct);


        toast('Productos Creados!', 'success');

        return redirect()->route('products.index');
    }



}
