@extends('layouts.app')

@section('title', 'Detalle Instrumental')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('instrumental.index') }}">Base Datos Instrumental</a></li>
        <li class="breadcrumb-item active">Detalle</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="bi bi-info-circle"></i> Información del Instrumental
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                @can('edit_instrumentals')
                                    <a href="{{ route('instrumental.edit', $instrumental->id) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                @endcan
                                
                                <a href="{{ route('instrumental.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Volver al Listado
                                </a>

                                @can('delete_instrumentals')
                                    <form action="{{ route('instrumental.destroy', $instrumental->id) }}" method="POST" 
                                          style="display: inline-block;"
                                          onsubmit="return confirm('¿Está seguro de eliminar este instrumental?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        <hr>

                        <!-- Información Principal -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-primary mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <strong>Información General</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 40%;">ID:</th>
                                                    <td>
                                                        <span class="badge badge-info">{{ $instrumental->id }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Código Único:</th>
                                                    <td><strong>{{ $instrumental->codigo_unico_ud }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <th>Descripción:</th>
                                                    <td>{{ $instrumental->nombre_generico }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Familia:</th>
                                                    <td>{{ $instrumental->tipo_familia }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Fabricante:</th>
                                                    <td>{{ $instrumental->marca_fabricante }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-success mb-3">
                                    <div class="card-header bg-success text-white">
                                        <strong>Estado y Fecha</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th style="width: 40%;">Estado:</th>
                                                    <td>
                                                        @php
                                                            $badges = [
                                                                'DISPONIBLE' => 'success',
                                                                'EN_USO' => 'primary',
                                                                'MANTENIMIENTO' => 'warning',
                                                                'BAJA' => 'danger',
                                                            ];
                                                            $color = $badges[$instrumental->estado_actual] ?? 'secondary';
                                                        @endphp
                                                        <span class="badge badge-{{ $color }} p-2">
                                                            {{ str_replace('_', ' ', $instrumental->estado_actual) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Fecha de Compra:</th>
                                                    <td>
                                                        @if($instrumental->fecha_compra)
                                                            <i class="bi bi-calendar-event"></i> 
                                                            {{ $instrumental->fecha_compra->format('d/m/Y') }}
                                                            <br>
                                                            <small class="text-muted">
                                                                ({{ $instrumental->fecha_compra->diffForHumans() }})
                                                            </small>
                                                        @else
                                                            <span class="text-muted">No disponible</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Product ID:</th>
                                                    <td>
                                                        @if($instrumental->product_id)
                                                            <span class="badge badge-info">{{ $instrumental->product_id }}</span>
                                                            @if($instrumental->product)
                                                                <br>
                                                                <small class="text-muted">
                                                                    {{ $instrumental->product->product_name ?? 'N/A' }}
                                                                </small>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-secondary">Sin asignar</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información de Auditoría -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <strong><i class="bi bi-clock-history"></i> Información de Auditoría</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Fecha de Creación:</label>
                                                    <p class="mb-0">
                                                        <i class="bi bi-calendar-plus"></i> 
                                                        {{ $instrumental->created_at->format('d/m/Y H:i:s') }}
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ $instrumental->created_at->diffForHumans() }}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Última Actualización:</label>
                                                    <p class="mb-0">
                                                        <i class="bi bi-calendar-check"></i> 
                                                        {{ $instrumental->updated_at->format('d/m/Y H:i:s') }}
                                                        <br>
                                                        <small class="text-muted">
                                                            {{ $instrumental->updated_at->diffForHumans() }}
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Tiempo en Sistema:</label>
                                                    <p class="mb-0">
                                                        <i class="bi bi-hourglass-split"></i> 
                                                        {{ $instrumental->created_at->diff($instrumental->updated_at)->format('%a días') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información Adicional del Producto (si existe) -->
                        @if($instrumental->product)
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="card border-warning">
                                        <div class="card-header bg-warning text-dark">
                                            <strong><i class="bi bi-box-seam"></i> Información del Producto Relacionado</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Código:</strong>
                                                    <p>{{ $instrumental->product->product_code ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Nombre:</strong>
                                                    <p>{{ $instrumental->product->product_name ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Cantidad:</strong>
                                                    <p>{{ $instrumental->product->product_quantity ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Acciones:</strong>
                                                    <p>
                                                        <a href="{{ route('products.show', $instrumental->product->id) }}" 
                                                           class="btn btn-sm btn-info">
                                                            <i class="bi bi-eye"></i> Ver Producto
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        // Script para imprimir la página
        function printInstrumental() {
            window.print();
        }
    </script>
@endpush