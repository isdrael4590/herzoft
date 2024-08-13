<?php

namespace Modules\Testbd\DataTables;

use Modules\Testbd\Entities\Testvacuum;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TestvacuumDataTable extends DataTable
{

    //insumos

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('testbd::testvacuums.partials.actions', compact('data'));
            })
            ->addColumn('validation_vacuum', function ($data) {
                return view('testbd::testvacuums.partials.validation_vacuum', compact('data'));
            })->addColumn('dates', function ($data) {
                return view('testbd::testvacuums.partials.dates', compact('data'));
            });
    }

    public function query(Testvacuum $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('testvacuum-table')
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


            Column::make('testvacuum_reference')
                ->title('Referencia.')
                ->className('text-center align-middle')
                ->orders('testvacuum_reference', 'desc'),
            Column::make('dates')
                ->title('Fecha')
                ->className('text-center align-middle'),

            Column::make('machine_name')
                ->title('Nombre del Equipo.')
                ->className('text-center align-middle'),

            Column::make('lote_machine')
                ->title('Lote del Equipo.')
                ->className('text-center align-middle'),


            Column::make('validation_vacuum')
                ->title('Validación del Ciclo.')
                ->className('text-center align-middle'),

            Column::computed('temp_ambiente')
                ->title('Temperatura del Ambiente.')
                ->className('text-center align-middle'),

            Column::computed('operator')
                ->title('Operador')
                ->className('text-center align-middle'),

            Column::computed('observation')
                ->title('Observaciones')
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
        return 'testvacuum_' . date('YmdHis');
    }
}
