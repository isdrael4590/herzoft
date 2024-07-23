<?php

namespace Modules\Stock\DataTables;

use Modules\Stock\Entities\Stock;
use Modules\Stock\Entities\StockDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StockDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)


            ->addColumn('action', function ($data) {
                return view('stock::partials.actions', compact('data'));
            });
    }

    public function query(Stock $model)
    {
        return $model->newQuery();
    }



    public function html()
    {
        return $this->builder()
            ->setTableId('Stock-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[1, 'desc']],
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

            Column::computed('reference')
                ->title('Referencia')
                ->className('text-center align-middle'),

            Column::make('lote_machine')
                ->title('Lote del equipo')
                ->className('text-center align-middle'),

            Column::make('machine_name')
                ->title('Equipo')
                ->className('text-center align-middle'),

            Column::make('lote_biologic')
                ->title('Lote del Biológico')
                ->className('text-center align-middle'),

            Column::make('note')
                ->title('Notas')
                ->className('text-center align-middle'),



        ];
    }

    protected function filename(): string
    {
        return 'StockDetails_' . date('YmdHis');
    }
}
