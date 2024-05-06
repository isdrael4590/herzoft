<?php

namespace Modules\Informat\DataTables;

use Modules\informat\Entities\Informat;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InformatDataTable extends DataTable
{

    //insumos

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('informat::informats.partials.actions', compact('data'));
            });
    }

    public function query(Informat $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('informat-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(7)
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


            Column::make('insumo_name')
                ->title('Nombre del Insumo.')
                ->className('text-center align-middle'),

            Column::make('insumo_code')
                ->title('Código del insumo.')
                ->className('text-center align-middle'),

            Column::make('insumo_type')
                ->title('Tipo del Insumo.')
                ->className('text-center align-middle'),

            Column::make('insumo_status')
                ->title('Estado Insumo.')
                ->className('text-center align-middle'),


            Column::computed('insumo_temp')
                ->title('Temperatura del Uso.')
                ->className('text-center align-middle'),

            Column::computed('insumo_lot')
                ->title('Lote del insumo.')
                ->className('text-center align-middle'),

            Column::computed('insumo_exp')
                ->title('Expiración del lote.')
                ->className('text-center align-middle'),

            Column::computed('insumo_unit')
                ->title('Presentación')
                ->className('text-center align-middle'),

            Column::computed('insumo_quantity')
                ->title('Cantidad.')
                ->className('text-center align-middle'),

            Column::computed('insumo_note')
                ->title('Observaciones')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'informat_' . date('YmdHis');
    }
}
