<?php

namespace Modules\Product\Http\Controllers;

use App\Imports\CategoryImport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Product\Entities\Category;
use Modules\Product\DataTables\ProductCategoriesDataTable;

class CategoriesController extends Controller
{

    public function index(ProductCategoriesDataTable $dataTable) {
        abort_if(Gate::denies('access_product_categories'), 403);

        return $dataTable->render('product::categories.index');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code',
            'category_name' => 'required'
        ]);

        Category::create([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('Product Category Created!', 'success');

        return redirect()->back();
    }


    public function edit($id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $category = Category::findOrFail($id);

        return view('product::categories.edit', compact('category'));
    }


    public function update(Request $request, $id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $request->validate([
            'category_code' => 'required|unique:categories,category_code,' . $id,
            'category_name' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'category_code' => $request->category_code,
            'category_name' => $request->category_name,
        ]);

        toast('Product Category Updated!', 'info');

        return redirect()->route('product-categories.index');
    }


    public function destroy($id) {
        abort_if(Gate::denies('access_product_categories'), 403);

        $category = Category::findOrFail($id);

        if ($category->products()->exists()) {
            return back()->withErrors('Can\'t delete because there are products associated with this category.');
        }

        $category->delete();

        toast('Product Category Deleted!', 'warning');

        return redirect()->route('product-categories.index');
    }

    public function ImportCategory(Request $request) {
        abort_if(Gate::denies('access_product_categories'), 403);

        
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv'
            ]);
    
            // Get the uploaded file
            $file = $request->file('file');
    
            // Import the data using the DataImport class
            Excel::import(new CategoryImport, $file);
    
            return redirect()->back()->with('success', 'Data imported successfully!');



        //return view('product-categories.index');
    }
}
