@php
    $Reception_max_id = \Modules\Reception\Entities\Reception::max('id') + 1;
    $reception_code = 'ING-RE_' . str_pad($Reception_max_id, 5, '0', STR_PAD_LEFT);
@endphp

@extends('layouts.app')

@section('title', 'Registrar Ingreso')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('receptions.index') }}">Recepción Instrumental</a></li>
        <li class="breadcrumb-item active">Añadir</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12">
                <livewire:search-producttoREPROC />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('utils.alerts')
                        <form id="RecepReprocess-form" action="{{ route('RecepReprocess.store') }}" method="POST">
                            @csrf

                            <div class="form-row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="reference">Referencia <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="reference" required readonly
                                        value="{{ $reception_code }}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>Area </label>
                                    <select class="form-control" name="area" id="area" required>
                                        <option value="Zona Esteril">Zona Esteril</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                <div class="form-group">
                                        <label>Persona que entrega</label>
                                        <input class="form-control" type="text" id="delivery_staff" name="delivery_staff"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Operador</label>
                                        <input class="form-control" type="text" id="operator" name="operator"
                                            placeholder= "{{ Auth::user()->name }}" value="{{ Auth::user()->name }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <livewire:product-carttoREPROC :cartInstance="'RecepReprocess'"/>
                            <div class="form-row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Estado de Ingreso <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="Pendiente">Pendiente</option>
                                            <option value="Registrado">Registrado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="note">Nota (Si se necesita)</label>
                                <textarea name="note" id="note" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Registrar Ingreso <i class="bi bi-check"></i>
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
