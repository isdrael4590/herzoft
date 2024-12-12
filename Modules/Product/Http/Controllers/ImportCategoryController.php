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

class ImportCategoryController extends Controller
{

  public function create()
    {
        abort_if(Gate::denies('create_importproducts'), 403);

        return view('product::categories.create');
    }
 /* 
    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required|file'
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Import the data using the DataImport class
        Excel::import(new CategoryImport, $file);

        return redirect()->back()->with('success', 'Data imported successfully!');
    }*/
    public function import(Request $request)
    {

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file'
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Import the data using the DataImport class
        Excel::import(new CategoryImport, $file);

        return redirect()->back()->with('success', 'Data imported successfully!');
    }
}