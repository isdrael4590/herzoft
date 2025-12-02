<?php

namespace Modules\Preparation\DataTables;

use Modules\Preparation\Entities\Preparation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PreparationDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('preparation::partials.actions', compact('data'));
            })
            ->addColumn('dates', function ($data) {
                return view('preparation::partials.dates', compact('data'));
            })
            ->addColumn('reception_reference', function ($data) {
                if ($data->reception) {
                    return '<a href="' . route('receptions.show', $data->reception_id) . '" 
                            class="badge bg-info text-decoration-none px-3 py-2" 
                            data-bs-toggle="tooltip" 
                            title="Ver detalles de recepción">
                            <i class="bi bi-box-arrow-in-down me-1"></i>' .
                        htmlspecialchars($data->reception->reference) .
                        '</a>';
                }
                return '<span class="badge bg-secondary px-2 py-1">Sin recepción</span>';
            })
            ->addColumn('total_products', function ($data) {
                $count = $data->preparationDetails()->count();
                if ($count > 0) {
                    return  $count . '</span>';
                }
                return '<span class="badge bg-light text-dark rounded-pill">0</span>';
            })
            ->addColumn('total_quantity', function ($data) {
                $total = $data->preparationDetails()->sum('product_quantity');
                if ($total > 0) {
                    return '<span class="badge bg-success rounded-pill fs-6">' . $total . '</span>';
                }
                return '<span class="badge bg-light text-dark rounded-pill">0</span>';
            })
            ->addColumn('products_list', function ($data) {
                if ($data->preparationDetails->count() === 0) {
                    return '<span class="text-muted small"><i class="bi bi-inbox"></i> Sin productos</span>';
                }

                $html = '<div class="products-list-container">';

                foreach ($data->preparationDetails as $index => $detail) {
                    // Limitar a mostrar máximo 5 productos directamente
                    if ($index < 6) {
                        $quantity = $detail->product_quantity;
                        $badgeClass = $quantity > 0 ? 'bg-success' : 'bg-secondary';

                        $html .= '<div class="product-item mb-1 p-2 border-bottom">';
                        $html .= '<div class="d-flex justify-content-between align-items-center">';
                        $html .= '<div class="flex-grow-1">';
                        $html .= '<code class="me-2 text-primary fw-bold">' . htmlspecialchars($detail->product_code) . '</code>';
                        $html .= '<span class="product-name">' . htmlspecialchars($detail->product_name) . '</span>';
                        $html .= '</div>';
                        $html .= '<span class="badge ' . $badgeClass . ' ms-2">' . $quantity . '</span>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                }

                // Si hay más de 6 productos, mostrar botón para ver todos
                if ($data->preparationDetails->count() > 6) {
                    $remaining = $data->preparationDetails->count() - 6;
                    $html .= '<button type="button" class="btn btn-sm btn-outline-primary mt-2 w-100 btn-show-more" ';
                    $html .= 'data-bs-toggle="modal" data-bs-target="#productsModal' . $data->id . '">';
                    $html .= '<i class="bi bi-plus-circle-fill me-1"></i> Ver ' . $remaining . ' producto' . ($remaining > 1 ? 's' : '') . ' más';
                    $html .= '</button>';
                }

                $html .= '</div>';

                // Modal para ver todos los productos
                $html .= $this->generateProductsModal($data);

                return $html;
            })
            ->addColumn('status_summary', function ($data) {
                $reception = $data->preparationDetails()
                    ->where('product_state_preparation', 'Recepcion')
                    ->count();
                $otros = $data->preparationDetails()
                    ->where('product_state_preparation', '!=', 'Recepcion')
                    ->count();

                $html = '<div class="d-flex flex-column gap-1">';
                if ($reception > 0) {
                    $html .= '<span class="badge bg-info">Recepción: ' . $reception . '</span>';
                }
                if ($otros > 0) {
                    $html .= '<span class="badge bg-secondary">Otros: ' . $otros . '</span>';
                }
                if ($reception === 0 && $otros === 0) {
                    $html .= '<span class="badge bg-light text-dark">Sin productos</span>';
                }
                $html .= '</div>';

                return $html;
            })
            ->rawColumns(['action', 'dates', 'reception_reference', 'total_products', 'total_quantity', 'products_list', 'status_summary'])
            ->orderColumn('reception_reference', function ($query, $order) {
                $query->leftJoin('receptions', 'preparations.reception_id', '=', 'receptions.id')
                    ->orderBy('receptions.reference', $order)
                    ->select('preparations.*');
            });
    }

protected function generateProductsModal($data)
{
    $modalId = 'productsModal' . $data->id;
    
    $html = '<div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">';
    $html .= '<div class="modal-dialog modal-xl modal-dialog-scrollable">';
    $html .= '<div class="modal-content">';
    
    // Header
    $html .= '<div class="modal-header bg-primary text-white">';
    $html .= '<h5 class="modal-title" id="' . $modalId . 'Label">';
    $html .= '<i class="bi bi-box-seam me-2"></i>Todos los Productos - ' . htmlspecialchars($data->reference);
    $html .= '</h5>';
    $html .= '<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>';
    $html .= '</div>';
    
    // Body
    $html .= '<div class="modal-body">';
    $html .= '<div class="table-responsive">';
    $html .= '<table class="table table-hover table-striped align-middle">';
    $html .= '<thead class="table-dark">';
    $html .= '<tr>';
    $html .= '<th width="12%">Código</th>';
    $html .= '<th width="30%">Producto</th>';
    $html .= '<th width="10%" class="text-center">Cantidad</th>';
    $html .= '<th width="12%" class="text-center">Estado</th>';
    $html .= '<th width="15%">Área</th>';
    $html .= '<th width="12%">Proceso</th>';
    $html .= '<th width="9%">Zona</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
    foreach ($data->preparationDetails as $detail) {
        $html .= '<tr>';
        $html .= '<td><code class="text-primary fw-bold">' . htmlspecialchars($detail->product_code) . '</code></td>';
        $html .= '<td><strong>' . htmlspecialchars($detail->product_name) . '</strong></td>';
        $html .= '<td class="text-center">';
        $badgeClass = $detail->product_quantity > 0 ? 'bg-success' : 'bg-secondary';
        $html .= '<span class="badge ' . $badgeClass . ' px-3 py-2">' . $detail->product_quantity . '</span>';
        $html .= '</td>';
        $html .= '<td class="text-center">';
        if ($detail->product_state_preparation == 'Recepcion') {
            $html .= '<span class="badge bg-info px-3 py-2">' . htmlspecialchars($detail->product_state_preparation) . '</span>';
        } else {
            $html .= '<span class="badge bg-secondary px-3 py-2">' . htmlspecialchars($detail->product_state_preparation) . '</span>';
        }
        $html .= '</td>';
        $html .= '<td>' . htmlspecialchars($detail->product_area ?? '-') . '</td>';
        $html .= '<td>' . htmlspecialchars($detail->product_type_process ?? '-') . '</td>';
        $html .= '<td>' . htmlspecialchars($detail->product_coming_zone ?? '-') . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</tbody>';
    $html .= '<tfoot class="table-light">';
    $html .= '<tr>';
    $html .= '<td colspan="2" class="text-end"><strong>TOTAL:</strong></td>';
    $html .= '<td class="text-center">';
    // SIN COLOR - solo texto negro
    $html .= '<strong><span class="fs-5 px-3 py-2">' . $data->preparationDetails->sum('product_quantity') . '</span></strong>';
    $html .= '</td>';
    $html .= '<td colspan="4" class="text-end"><strong>' . $data->preparationDetails->count() . ' productos</strong></td>';
    $html .= '</tr>';
    $html .= '</tfoot>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '</div>';
    
    // Footer
    $html .= '<div class="modal-footer">';
    $html .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">';
    $html .= '<i class="bi bi-x-circle me-1"></i> Cerrar';
    $html .= '</button>';
    $html .= '</div>';
    
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}

    public function query(Preparation $model)
    {
        return $model->newQuery()
            ->with(['preparationDetails', 'reception'])
            ->select('preparations.*');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('preparations-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->parameters([
                'order' => [[1, 'desc']],
                'pageLength' => 10,
                'responsive' => false,
                'autoWidth' => false,
                'scrollX' => true,
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
                ->title('Acciones')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->className('text-center align-middle'),

            Column::make('dates')
                ->title('Fecha')
                ->width(150)
                ->className('text-center align-middle'),

            Column::make('reference')
                ->title('Referencia')
                ->width(120)
                ->className('text-center align-middle'),

            Column::computed('reception_reference')
                ->title('Ref. Recepción')
                ->width(150)
                ->className('text-center align-middle')
                ->orderable(true),

            Column::computed('total_products')
                ->title('Total Productos')
                ->width(80)
                ->className('text-center align-middle')
                ->exportable(true)
                ->printable(true),



            Column::computed('products_list')
                ->title('Lista de Productos')
                ->width(350)
                ->className('align-middle')
                ->exportable(false)
                ->printable(false)
                ->orderable(false),


            Column::make('operator')
                ->title('Operador')
                ->width(150)
                ->className('text-center align-middle'),

            Column::make('note')
                ->title('Notas')
                ->className('align-middle'),
        ];
    }

    protected function filename(): string
    {
        return 'preparation_' . date('YmdHis');
    }
}
