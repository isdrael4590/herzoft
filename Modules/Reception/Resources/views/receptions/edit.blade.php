@extends('layouts.app')

@section('title', 'Editar Ingreso')


@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('receptions.index') }}">Recepción Instrumental</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-product />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="reception-form" action="{{ route('receptions.update', $reception) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $reception->reference }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Área Procedente</label>
                                        <select class="form-control" id="area" name="area" required>
                                            @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                                <option
                                                    {{ $reception->area == $area->area_name ? 'selected' : '' }}value="{{ $area->area_name }}">
                                                    {{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Persona que entrega</label>
                                        <input class="form-control" type="text" id="delivery_staff" name="delivery_staff"
                                            value="{{ $reception->delivery_staff }}" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="from-group">
                                        <div class="form-group">
                                            <label>Operador</label>
                                            <input class="form-control" type="text" id="operator" name="operator"
                                                placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <livewire:product-cart :cartInstance="'reception'" :data="$reception" />

                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Estado de Ingreso <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option {{ $reception->status == 'Pendiente' ? 'selected' : '' }}
                                                value="Pendiente">Pendiente</option>
                                            <option {{ $reception->status == 'Registrado' ? 'selected' : '' }}
                                                value="Registrado">Registrado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control">{{ $reception->note }}</textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualización Ingreso <i class="bi bi-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
@endpush
