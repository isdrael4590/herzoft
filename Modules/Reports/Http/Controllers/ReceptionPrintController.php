<?php

namespace Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Reception\Entities\Reception;
use Modules\Informat\Entities\Institute;
use Modules\Setting\Entities\Setting;
use PDF;

class ReceptionPrintController extends Controller
{
    // MÉTODO ORIGINAL (mantener para compatibilidad)
    public function printFromPost(Request $request)
    {
        $request->validate([
            'items' => 'required|string'
        ]);

        $items = json_decode($request->items, true);

        if (!is_array($items) || empty($items)) {
            return redirect()->back()->with('error', 'No valid items selected for printing');
        }

        \Log::info("POST Method: Processing {count($items)} items");

        return $this->generatePdf($items);
    }

    // NUEVO MÉTODO - Leer desde la sesión
    public function printFromSession()
    {
        $items = Session::get('print_reception_items');
        $timestamp = Session::get('print_reception_timestamp');

        if (!$items || !is_array($items) || empty($items)) {
            return redirect()->back()->with('error', 'No hay elementos válidos en la sesión para imprimir');
        }

        // Verificar que la sesión no sea muy antigua (30 minutos)
        if ($timestamp && $timestamp->diffInMinutes(now()) > 30) {
            Session::forget(['print_reception_items', 'print_reception_timestamp']);
            return redirect()->back()->with('error', 'La sesión de impresión ha expirado. Intente nuevamente.');
        }

        \Log::info("Session Method: Processing " . count($items) . " items");

        // Limpiar la sesión después de usar
        Session::forget(['print_reception_items', 'print_reception_timestamp']);

        return $this->generatePdf($items);
    }

    // NUEVO MÉTODO - Procesar chunks desde la sesión
    public function printFromChunks()
    {
        $chunks = Session::get('print_reception_chunks');
        $totalItems = Session::get('print_reception_total_items', 0);

        if (!$chunks || !is_array($chunks) || empty($chunks)) {
            return redirect()->back()->with('error', 'No hay chunks válidos en la sesión para imprimir');
        }

        // Combinar todos los chunks
        $items = collect($chunks)->flatten()->toArray();

        \Log::info("Chunks Method: Processing {$totalItems} items in " . count($chunks) . " chunks");

        // Limpiar la sesión
        Session::forget(['print_reception_chunks', 'print_reception_total_items', 'print_reception_timestamp']);

        return $this->generatePdf($items);
    }

    // NUEVO MÉTODO - Generación directa (para llamada desde Livewire)
    public function generatePdfDirect(array $items)
    {
        return $this->generatePdf($items);
    }

    // MÉTODO MEJORADO - Generación de PDF optimizado
    private function generatePdf(array $items)
    {
        try {
            $itemCount = count($items);
            \Log::info("Generating PDF for {$itemCount} items");

            // Validar que los items no estén vacíos
            if (empty($items)) {
                throw new \Exception('No items provided for PDF generation');
            }

            // Configurar límites según el volumen
            $this->setResourceLimits($itemCount);

            // Obtener datos de manera optimizada
            $receptions = $this->getReceptionsOptimized($items, $itemCount);

            if ($receptions->isEmpty()) {
                throw new \Exception('No valid receptions found for the provided IDs');
            }

            \Log::info("Found {$receptions->count()} valid receptions out of {$itemCount} requested");

            // Obtener datos adicionales
            $institute = Institute::first();
            $setting = Setting::first();

            // Procesar imágenes
            $dataUrl = $this->processImage($institute, 'institutes');
            $dataUrlogo = $this->processImage($setting, 'settings');

            // Calcular estadísticas
            $totalPackages = $receptions->sum(function ($reception) {
                return $reception->receptionDetails->count();
            });

            $statusStats = $receptions->groupBy('status')->map(function ($group) {
                return $group->count();
            });

            // Preparar datos para el PDF
            $pdfData = [
                'receptions' => $receptions,
                'institute' => $institute,
                'setting' => $setting,
                'dataUrl' => $dataUrl,
                'dataUrlogo' => $dataUrlogo,
                'total_items' => $itemCount,
                'print_date' => now()->format('d M, Y H:i:s'),
                'selected_count' => $receptions->count(),
                'total_packages' => $totalPackages,
                'status_stats' => $statusStats
            ];

            // Configurar opciones del PDF
            $pdfOptions = $this->getPdfOptions($itemCount);

            // Seleccionar vista según el volumen
            $viewName = $this->getViewName($itemCount);

            // Generar PDF con manejo de errores mejorado
            try {
                $pdf = PDF::loadView($viewName, $pdfData)
                    ->setOptions($pdfOptions);
            } catch (\Exception $e) {
                \Log::error('Error loading PDF view: ' . $e->getMessage());
                // Usar vista básica como fallback
                $pdf = PDF::loadView('reports::reception.print-basic', $pdfData)
                    ->setOptions($pdfOptions);
            }

            $filename = $this->generateFilename($itemCount);

            \Log::info("PDF generated successfully. Items: {$itemCount}, Filename: {$filename}");

            return $pdf->stream($filename);
        } catch (\Exception $e) {
            \Log::error('Error generating PDF: ' . $e->getMessage(), [
                'items_count' => count($items),
                'memory_usage' => memory_get_usage(true),
                'memory_peak' => memory_get_peak_usage(true),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Error generando PDF: ' . $e->getMessage() .
                    ' (Items: ' . count($items) . '). Intente con menos elementos o contacte al administrador.');
        }
    }

    private function setResourceLimits(int $itemCount)
    {
        if ($itemCount > 1000) {
            set_time_limit(300); // 5 minutos
            ini_set('memory_limit', '512M');
        }

        if ($itemCount > 5000) {
            set_time_limit(600); // 10 minutos
            ini_set('memory_limit', '1G');
        }

        if ($itemCount > 10000) {
            set_time_limit(1200); // 20 minutos
            ini_set('memory_limit', '2G');
        }
    }

    private function getReceptionsOptimized(array $items, int $itemCount)
    {
        // Para volúmenes muy grandes, usar paginación en la consulta
        if ($itemCount > 5000) {
            $receptions = collect();
            $chunks = array_chunk($items, 1000);

            foreach ($chunks as $chunkIndex => $chunk) {
                \Log::info("Processing chunk " . ($chunkIndex + 1) . " of " . count($chunks));

                $chunkData = Reception::with(['receptionDetails' => function ($query) {
                    // Optimizar la carga de detalles si es necesario
                    $query->select('id', 'reception_id', 'product_name'); // Solo campos necesarios
                }])
                    ->whereIn('id', $chunk)
                    ->get();

                $receptions = $receptions->merge($chunkData);
            }

            return $receptions->sortByDesc('updated_at');
        } else {
            // Consulta normal para volúmenes menores
            return Reception::with(['receptionDetails' => function ($query) {
                $query->select('id', 'reception_id', 'product_name'); // *** Agregado product_name y quantity ***
            }])
                ->whereIn('id', $items)
                ->orderBy('updated_at', 'desc')
                ->get();
        }
    }

    private function getPdfOptions(int $itemCount)
    {
        $options = [
            'dpi' => $itemCount > 5000 ? 96 : 150,
            'defaultFont' => 'sans-serif',
            'isPhpEnabled' => true,
            'chroot' => public_path(),
            'isRemoteEnabled' => true,
            'defaultPaperSize' => 'a4',
            'orientation' => 'portrait'
        ];

        // Para PDFs muy grandes, optimizar configuración
        if ($itemCount > 10000) {
            $options['orientation'] = 'landscape';
            $options['dpi'] = 72;
        }

        return $options;
    }

    private function getViewName(int $itemCount)
    {
        if ($itemCount > 10000) {
            return 'reports::reception.print-minimal'; // Vista ultra-básica
        } elseif ($itemCount > 5000) {
            return 'reports::reception.print-optimized'; // Vista optimizada
        } else {
            return 'reports::reception.print-reception'; // Vista completa
        }
    }

    private function generateFilename(int $itemCount)
    {
        return 'reception-report-' . $itemCount . '-items-' . now()->format('Y-m-d-H-i-s') . '.pdf';
    }

    private function processImage($model, $collection)
    {
        if (!$model || !$model->getFirstMedia($collection)) {
            return null;
        }

        try {
            $imagePath = $model->getFirstMedia($collection)->getPath();

            if (!file_exists($imagePath)) {
                return null;
            }

            $imageContent = file_get_contents($imagePath);
            $base64 = base64_encode($imageContent);

            $imageInfo = getimagesize($imagePath);
            $mimeType = $imageInfo['mime'] ?? 'image/jpeg';

            return 'data:' . $mimeType . ';base64,' . $base64;
        } catch (\Exception $e) {
            \Log::warning('Error processing image: ' . $e->getMessage());
            return null;
        }
    }
}
