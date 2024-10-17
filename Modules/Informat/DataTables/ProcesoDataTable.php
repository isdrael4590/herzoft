<?php

namespace Modules\Informat\DataTables;

use Modules\Informat\Entities\Proceso;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProcesoDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('informat::procesos.partials.actions', compact('data'));
            });
    }

    public function query(Proceso $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('Informat_proceso-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(4)
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
        
            Column::make('proceso_code')
                ->title('Código Procesos')
                ->addClass('text-center'),

            Column::make('proceso_name')
                ->title('Nombre Proceso')
                ->addClass('text-center'),

            Column::make('proceso_type')
                ->title('Tipo de Proceso')
                ->addClass('text-center'),

            Column::make('proceso_temp')
                ->title('Temperatura de proceso')
                ->addClass('text-center'),

            Column::computed('action')
                ->title('Acción')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Proceso_' . date('YmdHis');
    }
}
