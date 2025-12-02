<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ProductsZonaPrintController extends Controller
{
    public function printFromSession()
    {
        try {
            // Recuperar datos de la sesión
            $selectedIds = Session::get('print_products_zona_items', []);
            $allData = Session::get('print_products_zona_data', []);
            $timestamp = Session::get('print_products_zona_timestamp');

            // Validar que los datos existen
            if (empty($selectedIds) || empty($allData)) {
                return redirect()->back()->with('error', 'No hay datos de impresión disponibles en la sesión.');
            }

            // Validar tiempo (datos válidos por 5 minutos)
            if ($timestamp && Carbon::parse($timestamp)->addMinutes(5)->isPast()) {
                Session::forget(['print_products_zona_items', 'print_products_zona_data', 'print_products_zona_timestamp']);
                return redirect()->back()->with('error', 'Los datos de impresión han expirado. Por favor genere nuevamente el reporte.');
            }

            // Filtrar solo los elementos seleccionados
            $selectedData = collect($allData)->filter(function ($item) use ($selectedIds) {
                return in_array($item['id'], $selectedIds);
            })->values()->toArray();

            if (empty($selectedData)) {
                return redirect()->back()->with('error', 'No se encontraron datos válidos para imprimir.');
            }

            // Preparar datos para el PDF
            $reportData = $this->prepareReportData($selectedData);

            // Generar PDF
            $pdf = PDF::loadView('reports::product.products-zona-print', $reportData);
            $pdf->setPaper('letter', 'landscape');

            // Limpiar sesión
            Session::forget(['print_products_zona_items', 'print_products_zona_data', 'print_products_zona_timestamp']);

            // Retornar PDF
            return $pdf->stream('reporte_productos_zonas_' . now()->format('Y-m-d_His') . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Error generando PDF de productos por áreas: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error generando el PDF: ' . $e->getMessage());
        }
    }

 private function prepareReportData($data)
{
    // Detectar tipo de agrupación
    $groupType = 'detail';
    
    if (!empty($data) && isset($data[0]['items'])) {
        $groupType = 'grouped';
    }

    // Calcular estadísticas
    $stats = [
        'total_records' => count($data),
        'total_quantity' => 0,
        'zonas' => [],
        'products' => [],
        'date_range' => [],
    ];

    if ($groupType === 'grouped') {
        foreach ($data as $group) {
            $stats['total_quantity'] += $group['total_quantity'] ?? 0;
            
            if (isset($group['items'])) {
                foreach ($group['items'] as $item) {
                    $stats['zonas'][$item['zona_name']] = ($stats['zonas'][$item['zona_name']] ?? 0) + 1;
                    $stats['products'][$item['product_name']] = true;
                    $stats['date_range'][] = $item['date'];
                }
            }
        }
    } else {
        foreach ($data as $item) {
            $stats['total_quantity'] += $item['quantity'] ?? 0;
            $stats['zonas'][$item['zona_name']] = ($stats['zonas'][$item['zona_name']] ?? 0) + 1;
            $stats['products'][$item['product_name']] = true;
            $stats['date_range'][] = $item['date'];
        }
    }

    $stats['unique_products'] = count($stats['products']);
    $stats['unique_zonas'] = count($stats['zonas']);

    if (!empty($stats['date_range'])) {
        $stats['start_date'] = Carbon::parse(min($stats['date_range']))->format('d/m/Y');
        $stats['end_date'] = Carbon::parse(max($stats['date_range']))->format('d/m/Y');
    }

    // NUEVO: Obtener información del instituto desde la configuración o BD
    $institute = [
        'name' => config('app.institute_name', 'Sistema de Gestión Médica'),
        'address' => config('app.institute_address', ''),
        'area' => config('app.institute_area', ''),
        'city' => config('app.institute_city', ''),
        'country' => config('app.institute_country', ''),
    ];

    // Si tienes los datos en la base de datos, puedes obtenerlos así:
    // $institute = \App\Models\Institute::first();
    // O si está en la sesión:
    // $institute = Session::get('institute_data', []);

    return [
        'data' => $data,
        'stats' => $stats,
        'groupType' => $groupType,
        'generated_at' => now()->format('d/m/Y H:i:s'),
        'generated_by' => auth()->user()->name ?? 'Sistema',
        'institute' => $institute, // NUEVO: Agregar información del instituto
    ];
}

    // Método alternativo para impresión directa
    public function generatePdfDirect($selectedIds)
    {
        try {
            // Aquí deberías cargar los datos directamente de la BD
            // Este es un método de respaldo si falla el método de sesión

            return redirect()->route('reports.products-zona.index')
                ->with('error', 'Este método requiere implementación adicional. Use el método principal de impresión.');
        } catch (\Exception $e) {
            \Log::error('Error en generatePdfDirect: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
