<?php

namespace Modules\Labelqr\DataTables;

use Modules\Labelqr\Entities\Labelqr;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LabelqrDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('dates', function ($data) {
                return view('labelqr::partials.dates', compact('data'));
            })
            ->addColumn('status_cycle', function ($data) {
                return view('labelqr::partials.status_cycle', compact('data'));
            })
            ->addColumn('details_process', function ($data) {
                return view('labelqr::partials.details_process', compact('data'));
            })
            ->addColumn('validation_biologic', function ($data) {
                return view('labelqr::partials.validation_biologic', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('labelqr::partials.actions', compact('data'));
            });
    }

    public function query(Labelqr $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('discharges-table')

            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(6)
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
            Column::make('dates')
                ->title('Fecha')
                ->className('text-center align-middle'),
            Column::make('expiration')
                ->title('Fecha de Expiración')
                ->className('text-center align-middle'),

            Column::make('reference')
                ->title('Ref. Proceso')
                ->className('text-center align-middle'),
            Column::computed('status_cycle')
                ->title('Estado Ciclo')
                ->className('text-center align-middle'),

            Column::computed('details_process')
                ->title('Instrumental Procesado')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('machine_name')
                ->title('Equipo')
                ->className('text-center align-middle'),

            Column::make('lote_machine')
                ->title('Lote Equipo')
                ->className('text-center align-middle'),

            Column::make('type_program')
                ->title('Tipo Programa')
                ->className('text-center align-middle'),

            Column::make('temp_machine')
                ->title('Temp. Equipo')
                ->className('text-center align-middle'),

            Column::make('temp_ambiente')
                ->title('Temp. Ambiente')
                ->className('text-center align-middle'),

            Column::make('note_labelqr')
                ->title('Notas')
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
        return 'Reception_' . date('YmdHis');
    }
}
