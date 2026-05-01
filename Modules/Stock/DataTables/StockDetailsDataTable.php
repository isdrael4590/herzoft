<?php

namespace Modules\Stock\DataTables;

use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\StockDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StockDetailsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('history', function ($data) {
                $url = route('stockDetails.codeHistory', urlencode($data->product_code));
                return '<a href="' . $url . '" class="btn btn-sm btn-info">
                            <i class="bi bi-clock-history"></i> Ver Historial
                        </a>';
            })
            ->filter(function ($query) {
                if ($search = request()->input('search.value')) {
                    $query->where(function ($q) use ($search) {
                        $q->where('product_name', 'like', "%{$search}%")
                          ->orWhere('product_code', 'like', "%{$search}%")
                          ->orWhere('product_area', 'like', "%{$search}%");
                    });
                }
            }, true)
            ->rawColumns(['history']);
    }

    public function query(StockDetails $model)
    {
        return $model->newQuery()
            ->select(
                'product_code',
                'product_name',
                'product_area',
                DB::raw('SUM(product_quantity) as total_quantity'),
                DB::raw('SUM(product_quantity_expedition) as total_expedition')
            )
            ->groupBy('product_code', 'product_name', 'product_area')
            ->orderBy('total_quantity', 'desc');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('StockDetails-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>>
                   'tr'
                   <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[2, 'desc']],
            ])
            ->buttons(
                Button::make('excel')->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('product_name')
                ->title('Nombre del Producto')
                ->className('text-center align-middle'),

            Column::make('product_code')
                ->title('Código del Producto')
                ->className('text-center align-middle'),

            Column::computed('total_quantity')
                ->title('Cantidad Disponible')
                ->className('text-center align-middle fw-bold'),

            Column::computed('total_expedition')
                ->title('Cantidad Despachada')
                ->className('text-center align-middle'),

            Column::make('product_area')
                ->title('Área')
                ->className('text-center align-middle'),

            Column::computed('history')
                ->title('Historial')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),
        ];
    }

    protected function filename(): string
    {
        return 'StockDetails_' . date('YmdHis');
    }
}
