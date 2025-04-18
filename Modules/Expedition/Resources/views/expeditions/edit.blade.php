@extends('layouts.app')

@section('title', 'Registrar Despacho')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('expeditions.index') }}">Generador Despacho</a></li>
        <li class="breadcrumb-item active">Editar Despacho</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-producttoEXP />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="expedition-form" action="{{ route('expeditions.update', $expedition) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required
                                            value="{{ $expedition->reference }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status_expedition">Estado del Despacho <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" name="status_expedition" id="status_expedition"
                                            required>
                                            <option {{ $expedition->status_expedition == 'Despachado' ? 'selected' : '' }}
                                                value="Despachado">
                                                Despachar</option>
                                            <option {{ $expedition->status_expedition == 'Pendiente' ? 'selected' : '' }}
                                                value="Pendiente">
                                                Pendiente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="temp_ambiente">Temperatura del Ambiente <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="temp_ambiente" required
                                            value="{{ $expedition->temp_ambiente }}" min="1" step="0.1">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="area_expedition">Area de expedición <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control" id="area_expedition" name="area_expedition" required>
                                            @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                                <option
                                                    {{ $expedition->area_expedition == $area->area_name ? 'selected' : '' }}
                                                    value="{{ $area->area_name }}">
                                                    {{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="staff_expedition">Persona quién Recibe <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="staff_expedition" required
                                            value="{{ $expedition->staff_expedition }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}"
                                            readonly>
                                    </div>
                                </div>
                            </div>


                            <livewire:product-carttoEXP :cartInstance="'expedition'" :data="$expedition" />


                            <div class="form-row">

                            </div>
                            <div class="form-group">
                                <label for="note_expedition">Nota (Si se necesita)</label>
                                <textarea name="note_expedition" id="note_expedition" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar despacho <i class="bi bi-check"></i>
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
