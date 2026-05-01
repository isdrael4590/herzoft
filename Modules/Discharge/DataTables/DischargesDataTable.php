<?php

namespace Modules\Discharge\DataTables;

use Modules\Discharge\Entities\Discharge;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DischargesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('dates', function ($data) {
                return view('discharge::partials.dates', compact('data'));
            })
            ->addColumn('status_cycle', function ($data) {
                return view('discharge::partials.status_cycle', compact('data'));
            })
            /*->addColumn('details_process', function ($data){return view('discharge::partials.details_process', compact('data'));})*/
            ->addColumn('validation_biologic', function ($data) {
                return view('discharge::partials.validation_biologic', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('discharge::partials.actions', compact('data'));
            })
            ->filterColumn('status_cycle', function ($query, $keyword) {
                $query->where('status_cycle', $keyword);
            });
    }

    public function query(Discharge $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('discharges-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>>" .
                 "'tr'" .
                 "<'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order'      => [[1, 'desc']],
                'pageLength' => 15,
                'responsive' => true,
                'language'   => [
                    'url' => '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json',
                ],
            ])
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Imprimir'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Resetear'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Recargar')
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),
        

            Column::make('reference')
                ->title('Ref. Proceso')
                ->className('text-center align-middle'),
                Column::make('dates')
                ->title('Fechas')
                ->className('text-center align-middle'),


            Column::computed('status_cycle')
                ->title('Estado Ciclo')
                ->searchable(true)
                ->className('text-center align-middle'),

            Column::computed('validation_biologic')
                ->title('Validación Biológico')
                ->className('text-center align-middle'),

            Column::computed('ruta_process')
                ->title('Ruta')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('machine_name')
                ->title('Equipo')
                ->className('text-center align-middle'),

            Column::make('lote_machine')
                ->title('Lote Equipo')
                ->className('text-center align-middle'),


            Column::make('operator')
                ->title('Operador')
                ->className('text-center align-middle'),





            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string
    {
        return 'Discharge_' . date('YmdHis');
    }
}
