<?php

namespace App\Livewire\Barcode;

use Livewire\Component;
use Milon\Barcode\Facades\DNS1DFacade;
use Modules\Product\Entities\Product;

class ProductTable extends Component
{

    /*  CONFIGURAR EL TAMAÑO DE LA ETIQUETA.         producto 70x35 mm
      1 inch = 72 point
      1 inch = 2.54 cm
      70 mm ==  70/25.4*72 = 198.4251968
      35 mm ==  35/25.4*72 = 99.2125984248
     s*/
     private $customPaper = array(0, 0, 99.2125984248, 198.4251968);
    public $product;
    public $quantity;
    public $barcodes;

    protected $listeners = ['productSelected'];

    public function mount()
    {
        $this->product = '';
        $this->quantity = 0;
        $this->barcodes = [];
    }

    public function render()
    {
        return view('livewire.barcode.product-table');
    }

    public function productSelected(Product $product)
    {
        $this->product = $product;
        $this->quantity = 1;
        $this->barcodes = [];
    }

    public function generateBarcodes(Product $product, $quantity)
    {
        if ($quantity > 100) {
            return session()->flash('message', 'Max quantity is 100 per barcode generation!');
        }



        $this->barcodes = [];

        for ($i = 1; $i <= $quantity; $i++) {
            $barcode = DNS1DFacade::getBarCodeSVG($product->product_code, $product->product_barcode_symbology, 2, 60, 'black', false);
            array_push($this->barcodes, $barcode);
        }
    }

    public function getPdf()
    {
        // $sanitizedData = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
        $pdf = \PDF::loadView('product::barcode.print', [
            'barcodes' => $this->barcodes,
            'name' => $this->product->product_name,
        ])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])->setpaper($this->customPaper, 'landscape');
        return $pdf;
    }

    public function updatedQuantity()
    {
        $this->barcodes = [];
    }
}
