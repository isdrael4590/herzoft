<?php

namespace Modules\Stock\DataTables;

use Modules\Stock\Entities\Stock;
use Modules\Stock\Entities\StockDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StockDetailsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->orderColumn('product_status_stock', function ($query) {
                $query->orderBy('status', 'Disponible');
            })
            ->addColumn('dates', function ($data) {
                return view('stock::partials.dates', compact('data'));
            })
            /*->addColumn('details_process', function ($data) {
                return view('stock::partials.details_process', compact('data'));
            })*/
            ->addColumn('status_stock', function ($data) {
                return view('stock::partials.status_stock', compact('data'));
            })

            ->addColumn('action', function ($data) {
                return view('stock::partials.actions2', compact('data'));
            });
    }

    public function query(StockDetails $model)
    {
        return $model->newQuery();
    }



    public function html()
    {
        return $this->builder()
            ->setTableId('StockDetails-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[1, 'dsc']],
            ])
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('product_date_sterilized')
                ->title('Fecha Esterilización')
                ->className('text-center align-middle'),

            Column::computed('product_name')
                ->title('Nombre del producto')
                ->className('text-center align-middle'),

            Column::make('product_code')
                ->title('Código del producto')
                ->className('text-center align-middle'),

            Column::make('product_package_wrap')
                ->title('Tipo de embalaje')
                ->className('text-center align-middle'),

            Column::make('product_status_stock')
                ->title('Estado Disponibilidad')
                ->className('text-center align-middle'),

            /* Column::make('status_stock')
                ->title('Estado del Stock')
                ->className('text-center align-middle'),
*/
            Column::make('dates')
                ->title('Fecha de vencimiento')
                ->className('text-center align-middle'),

        ];
    }
    protected function filename(): string
    {
        return 'StockDetails_' . date('YmdHis');
    }
}
