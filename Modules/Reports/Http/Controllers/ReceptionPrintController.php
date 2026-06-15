<?php

namespace Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Informat\Entities\Institute;
use Modules\Setting\Entities\Setting;
use PDF;

class ReceptionPrintController extends Controller
{
    public function printFromPost(Request $request)
    {
        $request->validate(['items' => 'required|string']);
        $items = json_decode($request->items, true);

        if (!is_array($items) || empty($items)) {
            return redirect()->back()->with('error', 'No valid items selected for printing');
        }

        return $this->generatePdf($items, []);
    }

    public function printFromSession()
    {
        $items     = Session::get('print_reception_items');
        $timestamp = Session::get('print_reception_timestamp');
        $filters   = Session::get('print_reception_filters', []);

        if (!$items || !is_array($items) || empty($items)) {
            return redirect()->back()->with('error', 'No hay elementos en la sesión para imprimir.');
        }

        if ($timestamp && $timestamp->diffInMinutes(now()) > 30) {
            Session::forget(['print_reception_items', 'print_reception_timestamp', 'print_reception_filters', 'print_reception_groupby']);
            return redirect()->back()->with('error', 'La sesión expiró. Intente nuevamente.');
        }

        Session::forget(['print_reception_items', 'print_reception_timestamp', 'print_reception_filters', 'print_reception_groupby']);

        return $this->generatePdf($items, $filters);
    }

    public function printFromChunks()
    {
        $chunks     = Session::get('print_reception_chunks');
        $totalItems = Session::get('print_reception_total_items', 0);

        if (!$chunks || !is_array($chunks) || empty($chunks)) {
            return redirect()->back()->with('error', 'No hay chunks en la sesión para imprimir.');
        }

        $items = collect($chunks)->flatten()->toArray();
        Session::forget(['print_reception_chunks', 'print_reception_total_items', 'print_reception_timestamp']);

        return $this->generatePdf($items, []);
    }

    // ── Generación del PDF ──────────────────────────────────────────────────

    private function generatePdf(array $ids, array $filters): mixed
    {
        try {
            set_time_limit(120);
            ini_set('memory_limit', '256M');

            $itemCount = count($ids);
            $groupBy   = $filters['groupBy'] ?? 'date';

            Log::info("PDF: {$itemCount} recepciones, groupBy={$groupBy}");

            // ── 1. Datos institucionales ──────────────────────────────────
            $institute  = Institute::first();
            $setting    = Setting::first();
            $dataUrl    = $this->processImage($institute, 'institutes');
            $dataUrlogo = $this->processImage($setting, 'settings');

            // ── 2. KPIs globales (2 queries rápidas, sin Eloquent) ────────
            $totalReceptions = count($ids);

            $totalPackages = DB::table('reception_details')
                ->whereIn('reception_id', $ids)
                ->count();

            $statusStats = DB::table('receptions')
                ->whereIn('id', $ids)
                ->select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');

            // ── 3. Resumen por área (siempre presente) ────────────────────
            $areaSummary = DB::table('receptions as r')
                ->leftJoin('reception_details as rd', 'rd.reception_id', '=', 'r.id')
                ->whereIn('r.id', $ids)
                ->select([
                    'r.area',
                    DB::raw('COUNT(DISTINCT r.id) as records_count'),
                    DB::raw('COUNT(rd.id) as packages_count'),
                    DB::raw('COALESCE(SUM(rd.product_quantity), 0) as total_quantity'),
                ])
                ->groupBy('r.area')
                ->orderByDesc('records_count')
                ->get();

            // ── 3b. Resumen por fecha (siempre presente) ──────────────────
            $dateSummary = DB::table('receptions as r')
                ->leftJoin('reception_details as rd', 'rd.reception_id', '=', 'r.id')
                ->whereIn('r.id', $ids)
                ->select([
                    DB::raw('DATE(r.updated_at) as date'),
                    DB::raw('COUNT(DISTINCT r.id) as records_count'),
                    DB::raw('COUNT(rd.id) as packages_count'),
                    DB::raw('COALESCE(SUM(rd.product_quantity), 0) as total_quantity'),
                ])
                ->groupBy(DB::raw('DATE(r.updated_at)'))
                ->orderByDesc('date')
                ->get();

            // ── 4. Datos agrupados según el modo elegido ──────────────────
            $groupedData = match ($groupBy) {
                'product'   => $this->groupedByProduct($ids),
                'area'      => $this->groupedByArea($ids),
                'code_date' => $this->groupedByCodeDate($ids),
                default     => $this->groupedByDate($ids),
            };

            // ── 5. Preparar datos del PDF ─────────────────────────────────
            $pdfData = [
                'institute'        => $institute,
                'setting'          => $setting,
                'dataUrl'          => $dataUrl,
                'dataUrlogo'       => $dataUrlogo,
                'print_date'       => now()->format('d/m/Y H:i:s'),
                'filters'          => $filters,
                'total_receptions' => $totalReceptions,
                'total_packages'   => $totalPackages,
                'status_stats'     => $statusStats,
                'area_summary'     => $areaSummary,
                'date_summary'     => $dateSummary,
                'grouped_data'     => $groupedData,
                'group_by'         => $groupBy,
            ];

            $pdf = PDF::loadView('reports::reception.print-aggregated', $pdfData)
                ->setOptions([
                    'dpi'             => 96,
                    'defaultFont'     => 'sans-serif',
                    'isPhpEnabled'    => true,
                    'chroot'          => public_path(),
                    'isRemoteEnabled' => true,
                    'defaultPaperSize'=> 'a4',
                    'orientation'     => 'portrait',
                ]);

            $filename = 'recepciones-' . now()->format('Y-m-d') . '-' . $totalReceptions . '.pdf';

            Log::info("PDF generado: {$filename}");

            return $pdf->stream($filename);

        } catch (\Throwable $e) {
            Log::error('Error generando PDF: ' . $e->getMessage(), [
                'ids_count'    => count($ids),
                'memory'       => memory_get_usage(true),
                'trace'        => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    // ── Queries agregadas ───────────────────────────────────────────────────

    private function groupedByDate(array $ids): \Illuminate\Support\Collection
    {
        return DB::table('receptions as r')
            ->leftJoin('reception_details as rd', 'rd.reception_id', '=', 'r.id')
            ->whereIn('r.id', $ids)
            ->select([
                DB::raw('DATE(r.updated_at) as date'),
                DB::raw('COUNT(DISTINCT r.id) as records_count'),
                DB::raw('COUNT(DISTINCT COALESCE(rd.product_code, rd.product_name)) as products_count'),
                DB::raw('COUNT(DISTINCT r.area) as areas_count'),
                DB::raw('COALESCE(SUM(rd.product_quantity), 0) as total_quantity'),
                DB::raw('COUNT(rd.id) as total_packages'),
            ])
            ->groupBy(DB::raw('DATE(r.updated_at)'))
            ->orderByDesc('date')
            ->get();
    }

    private function groupedByProduct(array $ids): \Illuminate\Support\Collection
    {
        return DB::table('reception_details as rd')
            ->join('receptions as r', 'r.id', '=', 'rd.reception_id')
            ->whereIn('r.id', $ids)
            ->select([
                DB::raw('COALESCE(rd.product_code, rd.product_name) as group_key'),
                'rd.product_name',
                'rd.product_code',
                DB::raw('COALESCE(SUM(rd.product_quantity), 0) as total_quantity'),
                DB::raw('COUNT(DISTINCT r.id) as records_count'),
                DB::raw('COUNT(rd.id) as total_packages'),
            ])
            ->groupBy('group_key', 'rd.product_name', 'rd.product_code')
            ->orderByDesc('total_quantity')
            ->get();
    }

    private function groupedByArea(array $ids): \Illuminate\Support\Collection
    {
        return DB::table('receptions as r')
            ->leftJoin('reception_details as rd', 'rd.reception_id', '=', 'r.id')
            ->whereIn('r.id', $ids)
            ->select([
                'r.area',
                DB::raw('COUNT(DISTINCT r.id) as records_count'),
                DB::raw('COUNT(DISTINCT COALESCE(rd.product_code, rd.product_name)) as products_count'),
                DB::raw('COALESCE(SUM(rd.product_quantity), 0) as total_quantity'),
                DB::raw('COUNT(rd.id) as total_packages'),
            ])
            ->groupBy('r.area')
            ->orderByDesc('records_count')
            ->get();
    }

    private function groupedByCodeDate(array $ids): \Illuminate\Support\Collection
    {
        return DB::table('reception_details as rd')
            ->join('receptions as r', 'r.id', '=', 'rd.reception_id')
            ->whereIn('r.id', $ids)
            ->select([
                DB::raw('DATE(r.updated_at) as date'),
                'rd.product_code',
                'rd.product_name',
                DB::raw('COALESCE(SUM(rd.product_quantity), 0) as total_quantity'),
                DB::raw('COUNT(rd.id) as total_packages'),
                DB::raw('COUNT(DISTINCT r.id) as records_count'),
            ])
            ->groupBy(DB::raw('DATE(r.updated_at)'), 'rd.product_code', 'rd.product_name')
            ->orderByDesc('date')
            ->orderByDesc('total_quantity')
            ->get();
    }

    // ── Utilidades ──────────────────────────────────────────────────────────

    private function processImage($model, string $collection): ?string
    {
        if (!$model || !$model->getFirstMedia($collection)) {
            return null;
        }

        try {
            $path = $model->getFirstMedia($collection)->getPath();

            if (!file_exists($path)) return null;

            $info     = getimagesize($path);
            $mimeType = $info['mime'] ?? 'image/jpeg';

            return 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($path));
        } catch (\Throwable $e) {
            Log::warning('Error procesando imagen: ' . $e->getMessage());
            return null;
        }
    }
}
