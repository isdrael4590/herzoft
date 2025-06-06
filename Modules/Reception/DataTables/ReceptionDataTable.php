<?php

namespace Modules\Reception\DataTables;

use Modules\Reception\Entities\Reception;
use Modules\Reception\Entities\ReceptionDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Can;
use ZipStream\Zip64\EndOfCentralDirectory;

class ReceptionDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
       
            ->addColumn('reference', function ($data) {
                return view('reception::partials.reference', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('reception::partials.actions', compact('data'));
            })
            ->addColumn('dates', function ($data) {
                return view('reception::partials.dates', compact('data'));
            });
    }

    public function query(Reception $model)
    {
        return $model->newQuery();

          $user = auth()->user();
        
        // Filtrar por roles específicos
        if ($user->hasRole('admin') || $user->hasRole('supervisor') || $user->hasRole('tecnico')) {
            // Admin y supervisor pueden ver todos los estados
            return $query;
        } elseif ($user->hasRole('operador') || $user->hasRole('usuario')) {
            // Operador y recepcionista solo ven "Pendiente" y "Registrado"
            return $query->whereIn('status', ['Pendiente', 'Registrado']);
        } else {
            // Otros roles solo ven "Pendiente"
            return $query->where('status', 'Pendiente');
        }
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('receptions-table')
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
            Column::make('id')
                ->title('ID')
                ->className('text-center align-middle'),
            Column::make('dates')
                ->title('Fecha')
                ->className('text-center align-middle'),

            Column::make('reference')
                ->title('Referencia')
                ->className('text-center align-middle'),


            Column::make('delivery_staff')
                ->title('Persona Entrega')
                ->className('text-center align-middle'),

            Column::make('area')
                ->title('Área Procedente')
                ->className('text-center align-middle'),

            Column::make('note')
                ->title('Notas')
                ->className('text-center align-middle'),

            Column::make('operator')
                ->title('Operador')
                ->className('text-center align-middle'),

            Column::make('status')
                ->title('Estado')
                ->className('text-center align-middle'),


        ];
    }

    protected function filename(): string
    {
        return 'Reception_' . date('YmdHis');
    }
}
