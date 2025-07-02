<?php

namespace App\Livewire\Barcode;

use Livewire\Component;
use Milon\Barcode\Facades\DNS1DFacade;
use Modules\Product\Entities\Product;

class ProductTable extends Component
{
    private $customPaper = 'A4';

    public $product;
    public $quantity;
    public $barcodes = [];

    protected $listeners = ['productSelected'];

    public function mount()
    {
        $this->product = null;
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

    public function generateBarcodes()
    {
        // Validaciones mejoradas
        if (!$this->product || !($this->product instanceof Product)) {
            session()->flash('error', 'Please select a valid product first!');
            return;
        }

        if ($this->quantity <= 0) {
            session()->flash('error', 'Quantity must be greater than 0!');
            return;
        }

        if ($this->quantity > 100) {
            session()->flash('error', 'Max quantity is 100 per barcode generation!');
            return;
        }

        // Verificar que el producto tenga código
        $productCode = $this->product->product_code ?? null;
        if (empty($productCode)) {
            session()->flash('error', 'Product does not have a valid code!');
            return;
        }

        $this->barcodes = [];

        try {
            $symbology = $this->product->product_barcode_symbology ?? 'C128';

            for ($i = 1; $i <= $this->quantity; $i++) {
                // Generar SVG del código de barras con manejo de errores
                try {
                    $barcodeSvg = DNS1DFacade::getBarCodeSVG(
                        $productCode,
                        $symbology,
                        3, // Wider bars for better visibility
                        80, // Taller height
                        'black',
                        true // Show text
                    );

                    // Verificar que el SVG se generó correctamente
                    if (empty($barcodeSvg) || !is_string($barcodeSvg)) {
                        throw new \Exception('Failed to generate barcode SVG');
                    }
                } catch (\Exception $barcodeException) {
                    \Log::error('Individual Barcode Generation Error: ', [
                        'message' => $barcodeException->getMessage(),
                        'product_code' => $productCode,
                        'symbology' => $symbology
                    ]);

                    // Usar un fallback si falla la generación del SVG
                    $barcodeSvg = '<div class="barcode-fallback">' . htmlspecialchars($productCode) . '</div>';
                }

                $this->barcodes[] = [
                    'code' => $productCode,
                    'html' => $barcodeSvg,
                    'description' => $this->product->product_name ?? 'Product',
                    'symbology' => $symbology
                ];
            }

            session()->flash('success', "Generated {$this->quantity} barcode(s) successfully!");
        } catch (\Exception $e) {
            session()->flash('error', 'Error generating barcodes: ' . $e->getMessage());
            \Log::error('Barcode Generation Error: ', [
                'message' => $e->getMessage(),
                'product_code' => $productCode ?? 'N/A',
                'symbology' => $this->product->product_barcode_symbology ?? 'N/A',
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function downloadPdf()
    {
        if (empty($this->barcodes) || !is_array($this->barcodes)) {
            session()->flash('error', 'Please generate barcodes first!');
            return;
        }

        try {
            // Verificar que los códigos de barras tengan contenido
            $validBarcodes = [];
            foreach ($this->barcodes as $barcode) {
                if (is_array($barcode) && !empty($barcode['code']) && !empty($barcode['html'])) {
                    $validBarcodes[] = $barcode;
                }
            }

            if (empty($validBarcodes)) {
                session()->flash('error', 'No valid barcodes to generate PDF!');
                return;
            }

            \Log::info('PDF Generation - Valid Barcodes Count: ' . count($validBarcodes));

            // Preparar datos para la vista
            $viewData = [
                'barcodes' => $validBarcodes,
                'name' => $this->product->product_name ?? 'Product',
                'title' => 'Barcodes - ' . ($this->product->product_name ?? 'Product')
            ];

            // Verificar que la vista existe
            if (!view()->exists('product::barcode.print')) {
                throw new \Exception('Barcode print view not found');
            }

            // Generar PDF con manejo de errores mejorado
            $pdf = \PDF::loadView('product::barcode.print', $viewData);

            if (!$pdf) {
                throw new \Exception('Failed to initialize PDF generator');
            }

            // Configurar opciones del PDF
            $pdf->setOptions([
                'dpi' => 96,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => false,
                'chroot' => public_path(),
            ]);

            $pdf->setPaper($this->customPaper, 'portrait');

            // Generar el PDF
            $pdfOutput = $pdf->output();

            if (!$pdfOutput) {
                throw new \Exception('Failed to generate PDF output');
            }

            $filename = 'barcodes_' . str_replace([' ', '/', '\\', '<', '>', ':', '*', '?', '"', '|'], '_', $this->product->product_name ?? 'product') . '_' . date('Y-m-d_H-i-s') . '.pdf';

            return response()->streamDownload(function () use ($pdfOutput) {
                echo $pdfOutput;
            }, $filename, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            ]);
        } catch (\Exception $e) {
            session()->flash('error', 'Error generating PDF: ' . $e->getMessage());
            \Log::error('PDF Generation Error: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'barcodes_count' => count($this->barcodes ?? []),
                'product_data' => $this->product ? [
                    'id' => $this->product->id ?? 'N/A',
                    'name' => $this->product->product_name ?? 'N/A',
                    'code' => $this->product->product_code ?? 'N/A'
                ] : 'null'
            ]);
            return null;
        }
    }

    public function previewPdf()
    {
        if (empty($this->barcodes) || !is_array($this->barcodes)) {
            session()->flash('error', 'Please generate barcodes first!');
            return;
        }

        try {
            $validBarcodes = [];
            foreach ($this->barcodes as $barcode) {
                if (is_array($barcode) && !empty($barcode['code']) && !empty($barcode['html'])) {
                    $validBarcodes[] = $barcode;
                }
            }

            if (empty($validBarcodes)) {
                session()->flash('error', 'No valid barcodes to preview!');
                return;
            }

            $viewData = [
                'barcodes' => $validBarcodes,
                'name' => $this->product->product_name ?? 'Product',
                'title' => 'Barcodes Preview'
            ];

            $pdf = \PDF::loadView('product::barcode.print', $viewData);

            if (!$pdf) {
                throw new \Exception('Failed to initialize PDF generator for preview');
            }

            $pdf->setOptions([
                'dpi' => 96,
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => false
            ]);

            $pdf->setPaper($this->customPaper, 'portrait');

            $pdfOutput = $pdf->output();

            if (!$pdfOutput) {
                throw new \Exception('Failed to generate PDF preview output');
            }

            return response($pdfOutput, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="barcode_preview.pdf"');
        } catch (\Exception $e) {
            session()->flash('error', 'Error generating PDF preview: ' . $e->getMessage());
            \Log::error('PDF Preview Error: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    public function updatedQuantity()
    {
        $this->barcodes = [];
    }

    public function getProductInfo()
    {
        if (!$this->product || !($this->product instanceof Product)) {
            return null;
        }

        return [
            'name' => $this->product->product_name ?? 'N/A',
            'code' => $this->product->product_code ?? 'N/A',
            'symbology' => $this->product->product_barcode_symbology ?? 'C128',
        ];
    }

    // Método de debugging mejorado
    public function debugBarcodes()
    {
        $debugInfo = [
            'product_exists' => $this->product !== null,
            'product_type' => $this->product ? get_class($this->product) : 'null',
            'product_data' => $this->product ? [
                'id' => $this->product->id ?? 'N/A',
                'name' => $this->product->product_name ?? 'N/A',
                'code' => $this->product->product_code ?? 'N/A'
            ] : 'null',
            'quantity' => $this->quantity,
            'barcodes_count' => count($this->barcodes),
            'barcodes_type' => gettype($this->barcodes),
            'barcodes_sample' => array_slice($this->barcodes, 0, 2) // Solo primeros 2 elementos
        ];

        \Log::info('Debug Barcodes:', $debugInfo);

        session()->flash('success', 'Debug info logged. Check your logs.');
    }

    // Método adicional para limpiar estado
    public function resetBarcodes()
    {
        $this->barcodes = [];
        $this->quantity = 0;
        session()->flash('success', 'Barcodes reset successfully!');
    }
}
