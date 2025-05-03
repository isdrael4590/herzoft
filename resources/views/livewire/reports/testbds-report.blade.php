<div>
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
                                <label>Validación Test Bowie & Dick</label>
                                <select wire:model="validation_bd" class="form-control" name="validation_bd">
                                    <option value="">Selecione la Validación</option>
                                    <option value="Correcto">Correcto</option>
                                    <option value="Falla">Falla</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                                <th>Fecha</th>
                                <th>Referencia</th>
                                <th>Equipo</th>
                                <th>Lote Equipo</th>
                                <th>Validación</th>
                                <th>Lote BD</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $testbd)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($testbd['updated_at'])->format('d M, Y') }}</td>
                                    <td>{{ $testbd['testbd_reference'] }}</td>
                                    <td>{{ $testbd['machine_name'] }}</td>
                                    <td>{{ $testbd['lote_machine'] }}</td>

                                    <td>{{ $testbd['validation_bd'] }}</td>
                                    <td>{{ $testbd['lote_bd'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no Disponible de Test Bowie & Dick</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <button class="btn btn-success" wire:click="printtbd">Print Selected
                            ({{ count($this->selectedItems) }})</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
