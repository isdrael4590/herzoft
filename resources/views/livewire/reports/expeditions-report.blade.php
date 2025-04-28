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
                            <label for="endDate">Fecha FIn</label>
                            <input type="date" wire:model="endDate" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-primary" wire:click="loadData">Buscar</button>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Área</label>
                                <select wire:model="area_expedition" class="form-control" name="area_expedition">
                                    <option value="">Seleccione el Área</option>
                                    @foreach (\Modules\Informat\Entities\Area::all() as $area)
                                        <option value="{{ $area->area_name }}">{{ $area->area_name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <select wire:model="status_expedition" class="form-control" name="status_expedition">
                                    <option value="">Selecione el estado</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Despachado">Despachado</option>
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
                                <th>Persona que recibe</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $expedition)
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:model="selectedItems"
                                            value="{{ $expedition['id'] }}">
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($expedition['updated_at'])->format('d M, Y') }}</td>
                                    <td>{{ $expedition['reference'] }}</td>
                                    <td>{{ $expedition['area_expedition'] }}</td>
                                    <td>
                                        @if ($expedition['status_expedition'] == 'Pendiente')
                                            <span class="badge badge-info">
                                                {{ $expedition['status_expedition'] }}
                                            </span>
                                        @elseif ($expedition['status_expedition'] == 'Despachado')
                                            <span class="badge badge-primary">
                                                {{ $expedition['status_expedition'] }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $expedition['operator'] }}</td>
                                    <td>{{ $expedition['staff_expedition'] }}</td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no Disponible de Despacho</span>
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
