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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Equipo</label>
                                <select wire:model="machine_name" class="form-control" name="machine_name">
                                    <option value="">Seleccione el Equipo</option>
                                    @foreach (\Modules\Informat\Entities\Machine::all() as $machine)
                                        <option value="{{ $machine->machine_name }}">{{ $machine->machine_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Validación Biologico</label>
                                <select wire:model="validation_biologic" class="form-control"
                                    name="validation_biologic">
                                    <option value="">Selecione la Validación</option>
                                    <option value="Correcto">Correcto</option>
                                    <option value="Falla">Falla</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Validación Proceso</label>
                                <select wire:model="status_cycle" class="form-control" name="status_cycle">
                                    <option value="">Selecione el Estado de Proceso</option>
                                    <option value="Ciclo Aprobado ">Ciclo Aprobado</option>
                                    <option value="Ciclo Falla">Ciclo Falla</option>
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
                                <th>Equipo</th>
                                <th>Lote Equipo</th>
                                <th>Validación Proceso</th>
                                <th>Validación Biológico</th>
                                <th>Cantidad de Paquetes</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $discharge)
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:model="selectedItems"
                                            value="{{ $discharge['id'] }}">
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($discharge['updated_at'])->format('d M, Y') }}</td>
                                    <td>{{ $discharge['reference'] }}</td>
                                    <td>{{ $discharge['machine_name'] }}</td>
                                    <td>{{ $discharge['lote_machine'] }}</td>

                                    <td>
                                        @if ($discharge['status_cycle'] == 'Ciclo Falla')
                                            <span class="badge badge-info">
                                                {{ $discharge['status_cycle'] }}
                                            </span>
                                        @elseif ($discharge['status_cycle'] == 'Ciclo Aprobado')
                                            <span class="badge badge-primary">
                                                {{ $discharge['status_cycle'] }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($discharge['validation_biologic'] == 'Falla')
                                            <span class="badge badge-info">
                                                {{ $discharge['validation_biologic'] }}
                                            </span>
                                        @elseif ($discharge['validation_biologic'] == 'Correcto')
                                            <span class="badge badge-primary">
                                                {{ $discharge['validation_biologic'] }}
                                            </span>
                                        @endif

                                    </td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ $discharge['details_count'] }}
                                        </span>
                                    </td>
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
