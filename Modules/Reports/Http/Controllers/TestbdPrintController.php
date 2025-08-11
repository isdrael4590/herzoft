<?php

namespace Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Testbd\Entities\Testbd;
use Modules\Informat\Entities\Institute;
use Modules\Setting\Entities\Setting;
use PDF;

class TestbdPrintController extends Controller
{
    // MÉTODO ORIGINAL (mantener para compatibilidad)
    public function printData(Request $request)
    {
        $request->validate([
            'items' => 'required|string'
        ]);

        $items = explode(',', $request->items);

        if (empty($items)) {
            return redirect()->back()->with('error', 'No valid items selected for printing');
        }

        \Log::info("POST Method: Processing " . count($items) . " testbd items");

        return $this->generatePdf($items);
    }

    // NUEVO MÉTODO - Leer desde la sesión
    public function printFromSession()
    {
        $items = Session::get('print_testbd_items');
        $timestamp = Session::get('print_testbd_timestamp');

        if (!$items || !is_array($items) || empty($items)) {
            return redirect()->back()->with('error', 'No hay elementos válidos en la sesión para imprimir');
        }

        // Verificar que la sesión no sea muy antigua (30 minutos)
        if ($timestamp && $timestamp->diffInMinutes(now()) > 30) {
            Session::forget(['print_testbd_items', 'print_testbd_timestamp']);
            return redirect()->back()->with('error', 'La sesión de impresión ha expirado. Intente nuevamente.');
        }

        \Log::info("Session Method: Processing " . count($items) . " testbd items");

        // Limpiar la sesión después de usar
        Session::forget(['print_testbd_items', 'print_testbd_timestamp']);

        return $this->generatePdf($items);
    }

    // NUEVO MÉTODO - Procesar chunks desde la sesión
    public function printFromChunks()
    {
        $chunks = Session::get('print_testbd_chunks');
        $totalItems = Session::get('print_testbd_total_items', 0);

        if (!$chunks || !is_array($chunks) || empty($chunks)) {
            return redirect()->back()->with('error', 'No hay chunks válidos en la sesión para imprimir');
        }

        // Combinar todos los chunks
        $items = collect($chunks)->flatten()->toArray();

        \Log::info("Chunks Method: Processing {$totalItems} testbd items in " . count($chunks) . " chunks");

        // Limpiar la sesión
        Session::forget(['print_testbd_chunks', 'print_testbd_total_items', 'print_testbd_timestamp']);

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
            \Log::info("Generating TestBD PDF for {$itemCount} items");

            // Validar que los items no estén vacíos
            if (empty($items)) {
                throw new \Exception('No items provided for PDF generation');
            }

            // Configurar límites según el volumen
            $this->setResourceLimits($itemCount);

            // Obtener datos de manera optimizada
            $testbds = $this->getTestbdsOptimized($items, $itemCount);

            if ($testbds->isEmpty()) {
                throw new \Exception('No valid test BD records found for the provided IDs');
            }

            \Log::info("Found {$testbds->count()} valid testbds out of {$itemCount} requested");

            // Obtener datos adicionales
            $institute = Institute::first();
            $setting = Setting::first();

            // Procesar imágenes
            $dataUrl = $this->processImage($institute, 'institutes');
            $dataUrlogo = $this->processImage($setting, 'settings');

            // Calcular estadísticas específicas para TestBD
            $validationStats = $testbds->groupBy('validation_bd')->map(function ($group) {
                return $group->count();
            });

            $machineStats = $testbds->groupBy('machine_name')->map(function ($group) {
                return $group->count();
            });

            $validCount = $testbds->where('validation_bd', 'valid')->count();
            $invalidCount = $testbds->where('validation_bd', 'invalid')->count();
            $pendingCount = $testbds->where('validation_bd', 'pending')->count();

            // Preparar datos para el PDF
            $pdfData = [
                'testbds' => $testbds,
                'institute' => $institute,
                'setting' => $setting,
                'dataUrl' => $dataUrl,
                'dataUrlogo' => $dataUrlogo,
                'total_items' => $itemCount,
                'print_date' => now()->format('d M, Y H:i:s'),
                'selected_count' => $testbds->count(),
                'validation_stats' => $validationStats,
                'machine_stats' => $machineStats,
                'valid_count' => $validCount,
                'invalid_count' => $invalidCount,
                'pending_count' => $pendingCount,
                'success_rate' => $testbds->count() > 0 ? round(($validCount / $testbds->count()) * 100, 2) : 0
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
                \Log::error('Error loading TestBD PDF view: ' . $e->getMessage());
                // Usar vista básica como fallback
                $pdf = PDF::loadView('reports::testbd.print-testbd', $pdfData)
                    ->setOptions($pdfOptions);
            }

            $filename = $this->generateFilename($itemCount);

            \Log::info("TestBD PDF generated successfully. Items: {$itemCount}, Filename: {$filename}");

            return $pdf->stream($filename);
        } catch (\Exception $e) {
            \Log::error('Error generating TestBD PDF: ' . $e->getMessage(), [
                'items_count' => count($items),
                'memory_usage' => memory_get_usage(true),
                'memory_peak' => memory_get_peak_usage(true),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Error generando PDF TestBD: ' . $e->getMessage() .
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

    private function getTestbdsOptimized(array $items, int $itemCount)
    {
        // Para volúmenes muy grandes, usar paginación en la consulta
        if ($itemCount > 5000) {
            $testbds = collect();
            $chunks = array_chunk($items, 1000);

            foreach ($chunks as $chunkIndex => $chunk) {
                \Log::info("Processing TestBD chunk " . ($chunkIndex + 1) . " of " . count($chunks));

                $chunkData = Testbd::whereIn('id', $chunk)
                    ->orderBy('updated_at', 'desc')
                    ->get();

                $testbds = $testbds->merge($chunkData);

                // Liberar memoria después de cada chunk para grandes volúmenes
                if ($itemCount > 10000 && ($chunkIndex + 1) % 5 === 0) {
                    gc_collect_cycles();
                }
            }

            return $testbds->sortByDesc('updated_at');
        } else {
            // Consulta normal para volúmenes menores
            return Testbd::whereIn('id', $items)
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
            return 'reports::testbd.print-minimal'; // Vista ultra-básica
        } elseif ($itemCount > 5000) {
            return 'reports::testbd.print-optimized'; // Vista optimizada
        } else {
            return 'reports::testbd.print-testbd'; // Vista completa
        }
    }

    private function generateFilename(int $itemCount)
    {
        return 'testbd-report-' . $itemCount . '-items-' . now()->format('Y-m-d-H-i-s') . '.pdf';
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
            \Log::warning('Error processing image for TestBD report: ' . $e->getMessage());
            return null;
        }
    }

    // MÉTODOS ADICIONALES ESPECÍFICOS PARA TESTBD

    /**
     * Generar reporte por máquina específica
     */
    public function printByMachine(Request $request)
    {
        $request->validate([
            'machine_name' => 'required|string',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date'
        ]);

        $query = Testbd::where('machine_name', $request->machine_name);

        if ($request->date_from) {
            $query->where('updated_at', '>=', $request->date_from . ' 00:00:00');
        }

        if ($request->date_to) {
            $query->where('updated_at', '<=', $request->date_to . ' 23:59:59');
        }

        $testbds = $query->orderBy('updated_at', 'desc')->get();
        $items = $testbds->pluck('id')->toArray();

        if (empty($items)) {
            return redirect()->back()->with('error', 'No se encontraron registros para la máquina especificada');
        }

        return $this->generatePdf($items);
    }

    /**
     * Generar reporte de resumen por validación
     */
    public function printValidationSummary(Request $request)
    {
        $request->validate([
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date'
        ]);

        $query = Testbd::query();

        if ($request->date_from) {
            $query->where('updated_at', '>=', $request->date_from . ' 00:00:00');
        }

        if ($request->date_to) {
            $query->where('updated_at', '<=', $request->date_to . ' 23:59:59');
        }

        $testbds = $query->orderBy('updated_at', 'desc')->get();
        $items = $testbds->pluck('id')->toArray();

        if (empty($items)) {
            return redirect()->back()->with('error', 'No se encontraron registros para el rango de fechas especificado');
        }

        // Forzar el uso de la vista de resumen
        try {
            $pdfData = [
                'testbds' => $testbds,
                'institute' => Institute::first(),
                'setting' => Setting::first(),
                'dataUrl' => $this->processImage(Institute::first(), 'institutes'),
                'dataUrlogo' => $this->processImage(Setting::first(), 'settings'),
                'print_date' => now()->format('d M, Y H:i:s'),
                'date_from' => $request->date_from,
                'date_to' => $request->date_to,
                'validation_stats' => $testbds->groupBy('validation_bd')->map->count(),
                'machine_stats' => $testbds->groupBy('machine_name')->map->count(),
                'valid_count' => $testbds->where('validation_bd', 'valid')->count(),
                'invalid_count' => $testbds->where('validation_bd', 'invalid')->count(),
                'pending_count' => $testbds->where('validation_bd', 'pending')->count(),
            ];

            $pdf = PDF::loadView('reports::testbd.print-summary', $pdfData)
                ->setOptions($this->getPdfOptions(count($items)));

            $filename = 'testbd-validation-summary-' . now()->format('Y-m-d-H-i-s') . '.pdf';

            return $pdf->stream($filename);
        } catch (\Exception $e) {
            \Log::error('Error generating validation summary PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error generando reporte de resumen: ' . $e->getMessage());
        }
    }
}