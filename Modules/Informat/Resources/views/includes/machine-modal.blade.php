@php
    $Machine_max_id = \Modules\Informat\Entities\Machine::max('id') + 1;
    $machine_code = 'Eq_' . str_pad($Machine_max_id, 2, '0', STR_PAD_LEFT);
@endphp

<div class="modal fade" id="MachineCreateModal" tabindex="-1" role="dialog" aria-labelledby="MachineCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0" style="border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.15);">

            {{-- Modal Header --}}
            <div class="modal-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);padding:20px 28px;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:40px;height:40px;background:rgba(255,255,255,0.2);">
                        <i class="bi bi-gear text-white" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0 text-white font-weight-bold" id="MachineCreateModalLabel">
                            Nuevo Equipo
                        </h5>
                        <small class="text-white" style="opacity:.8;">Complete los datos del equipo esterilizador</small>
                    </div>
                </div>
                <button type="button" class="close text-white ml-auto" data-dismiss="modal" aria-label="Close"
                    style="opacity:.8;font-size:1.4rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('machine.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding:28px;">

                    {{-- Código (auto) --}}
                    <div class="mb-4 p-3 rounded d-flex align-items-center"
                        style="background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px !important;">
                        <i class="bi bi-hash mr-2" style="color:#8b5cf6;font-size:1.1rem;"></i>
                        <div>
                            <small class="text-muted d-block" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.5px;">Código generado automáticamente</small>
                            <strong class="text-dark">{{ $machine_code }}</strong>
                        </div>
                        <input type="hidden" name="machine_code" value="{{ $machine_code }}">
                    </div>

                    {{-- Campos --}}
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-tag mr-1" style="color:#8b5cf6;"></i>
                                    Nombre del Equipo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="machine_name" required
                                    placeholder="Ej: Autoclave"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-cpu mr-1" style="color:#8b5cf6;"></i>
                                    Modelo del Equipo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="machine_model" required
                                    placeholder="Ej: S1008"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-list-ul mr-1" style="color:#8b5cf6;"></i>
                                    Tipo de Equipo <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="machine_type" id="machine_type" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                                    <option value="" selected disabled>-- Seleccionar tipo --</option>
                                    <option value="Autoclave">Autoclave</option>
                                    <option value="Peroxido">Esterilizador de Peróxido</option>
                                    <option value="Lavadora">Lavadora Desinfectadora</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-123 mr-1" style="color:#8b5cf6;"></i>
                                    Serie del Equipo <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="machine_serial" required
                                    placeholder="Ej: SN-2024-001"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-shop mr-1" style="color:#8b5cf6;"></i>
                                    Marca del Esterilizador <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="machine_factory" required
                                    placeholder="Ej: Matachana"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-geo-alt mr-1" style="color:#8b5cf6;"></i>
                                    País de Fabricación <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="machine_country" required
                                    placeholder="Ej: España"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer border-0" style="padding:16px 28px 24px;gap:10px;">
                    <button type="button" class="btn btn-outline-secondary d-flex align-items-center"
                        data-dismiss="modal"
                        style="border-radius:8px;padding:9px 20px;font-weight:600;">
                        <i class="bi bi-x-circle mr-2"></i> Cancelar
                    </button>
                    <button type="submit"
                        class="btn d-flex align-items-center text-white"
                        style="border-radius:8px;padding:9px 22px;font-weight:600;background:linear-gradient(135deg,#8b5cf6,#6d28d9);box-shadow:0 4px 12px rgba(139,92,246,0.35);border:none;">
                        <i class="bi bi-check-lg mr-2"></i> Registrar Equipo
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
