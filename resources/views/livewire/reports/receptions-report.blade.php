<div>
    @if (session()->has('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="form-row">
                        <div class="col-md-5">
                            <label for="startDate">Fecha Inicio</label>
                            <input type="date" wire:model="startDate" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="endDate">Fecha Fin</label>
                            <input type="date" wire:model="endDate" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary" wire:click="loadData">Buscar</button>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Área</label>
                                <select wire:model="area" class="form-control" name="area">
                                    <option value="">Seleccione el área</option>
                                    @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                        <option value="{{ $area->area_name }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">

                                <label>Estado</label>
                                <select wire:model="status" class="form-control" name="status">
                                    <option value="">Selecione la Validación</option>
                                    <option value="Registrado">Registrado</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Procesado">Procesado</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0">
                        <div wire:loading.flex
                            class="col-12 position-absolute justify-content-center align-items-center"
                            style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" wire:model="selectAll">
                                </th>
                                <th>Fecha</th>
                                <th>Referencia</th>
                                <th>Área</th>
                                <th>Estado</th>
                                <th>Persona Entrega</th>
                                <th>Persona que Recibe</th>
                                <th>Cantidad de Paquetes</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $reception)
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:model="selectedItems"
                                            value="{{ $reception['id'] }}">
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($reception['updated_at'])->format('d M, Y') }}</td>
                                    <td>{{ $reception['reference'] }}</td>
                                    <td>{{ $reception['area'] }}</td>
                                    <td>{{ $reception['status'] }}</td>

                                    <td>{{ $reception['delivery_staff'] }}</td>
                                    <td>{{ $reception['operator'] }}</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ $reception['details_count'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no Disponible de Registro</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <button class="btn btn-success" wire:click="print">Print Selected
                            ({{ count($this->selectedItems) }})</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
