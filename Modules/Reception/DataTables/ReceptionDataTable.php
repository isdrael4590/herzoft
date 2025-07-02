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
        $query = $model->newQuery();
        $user = auth()->user();

        // Check permissions insteadca of roles
        if ($user->can('access_admin') || $user->can('access_user_management')) {
            // Admin  with all permission can see all receptions
            return $query;
        } elseif ($user->can('access_dirty_area')) {
            // Users with basic 'access_receptions' permission see limited statuses
            return $query->whereIn('status', ['Pendiente', 'Registrado']);
        } elseif ($user->can('show_receptions')) {
            // Users with reception area access see only pending items
            return $query->where('status', 'Pendiente');
        } else {
            // No permissions - return empty result
            return $query->whereRaw('1 = 0'); // This ensures no results are returned
        }
    }

    public function html()
    {
        $user = auth()->user();
        $buttons = [];

        // Add buttons based on permissions
        if ($user->can('print_receptions')) {
            $buttons[] = Button::make('excel')
                ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel');
            $buttons[] = Button::make('print')
                ->text('<i class="bi bi-printer-fill"></i> Print');
        }

        // Always allow reset and reload for users with access
        if ($user->can('access_receptions')) {
            $buttons[] = Button::make('reset')
                ->text('<i class="bi bi-x-circle"></i> Reset');
            $buttons[] = Button::make('reload')
                ->text('<i class="bi bi-arrow-repeat"></i> Reload');
        }

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
            ->buttons($buttons);
    }

    protected function getColumns()
    {
        $user = auth()->user();
        $columns = [];

        // Action column - only show if user can edit or delete
        if ($user->can('edit_receptions') || $user->can('delete_receptions')) {
            $columns[] = Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle');
        }
        if ($user->can('access_admin')) {

            $columns[] = Column::make('id')
                ->title('ID')
                ->className('text-center align-middle');
        }

        // Basic columns that all users with access can see
        if ($user->can('access_receptions')) {

            $columns[] = Column::make('dates')
                ->title('Fecha')
                ->className('text-center align-middle');

            $columns[] = Column::make('reference')
                ->title('Referencia')
                ->className('text-center align-middle');

            $columns[] = Column::make('delivery_staff')
                ->title('Persona Entrega')
                ->className('text-center align-middle');

            $columns[] = Column::make('area')
                ->title('Área Procedente')
                ->className('text-center align-middle');
        }

        // Additional columns for users with show permissions
        if ($user->can('show_receptions')) {


            $columns[] = Column::make('operator')
                ->title('Operador')
                ->className('text-center align-middle');

            $columns[] = Column::make('status')
                ->title('Estado')
                ->className('text-center align-middle');
            $columns[] = Column::make('note')
                ->title('Notas')
                ->className('text-center align-middle')
                ->renderAs(function ($row) {
                    if (!empty($row->note)) {
                        return '<button class="btn btn-sm btn-info" onclick="toggleNote(' . $row->id . ')">
                        <i class="fa fa-eye"></i> Ver Nota
                    </button>
                    <div id="note-' . $row->id . '" style="display:none; margin-top:10px; padding:10px; background:#f8f9fa; border-radius:5px;">
                        ' . nl2br(htmlspecialchars($row->note)) . '
                    </div>';
                    }
                    return '<span class="text-muted">Sin nota</span>';
                });
        }

        return $columns;
    }

    protected function filename(): string
    {
        return 'Reception_' . date('YmdHis');
    }
}
