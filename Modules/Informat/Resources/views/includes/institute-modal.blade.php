@php
    $Institute_max_id = \Modules\Informat\Entities\Institute::max('id') + 1;
    $institute_code = "Inst_" . str_pad($Institute_max_id, 2, '0', STR_PAD_LEFT)
@endphp

<div class="modal fade" id="InstituteCreateModal" tabindex="-1" role="dialog" aria-labelledby="InstituteCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0" style="border-radius:16px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.15);">

            {{-- Modal Header --}}
            <div class="modal-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#4f46e5,#3730a3);padding:20px 28px;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                        style="width:40px;height:40px;background:rgba(255,255,255,0.2);">
                        <i class="bi bi-hospital text-white" style="font-size:1.2rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0 text-white font-weight-bold" id="InstituteCreateModalLabel">
                            Nueva Institución
                        </h5>
                        <small class="text-white" style="opacity:.8;">Complete los datos de la institución</small>
                    </div>
                </div>
                <button type="button" class="close text-white ml-auto" data-dismiss="modal" aria-label="Close"
                    style="opacity:.8;font-size:1.4rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('institute.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="padding:28px;">

                    {{-- Código (auto) --}}
                    <div class="mb-4 p-3 rounded d-flex align-items-center"
                        style="background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px !important;">
                        <i class="bi bi-hash mr-2" style="color:#4f46e5;font-size:1.1rem;"></i>
                        <div>
                            <small class="text-muted d-block" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.5px;">Código generado automáticamente</small>
                            <strong class="text-dark">{{ $institute_code }}</strong>
                        </div>
                        <input type="hidden" name="institute_code" value="{{ $institute_code }}">
                    </div>

                    {{-- Información --}}
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-building mr-1" style="color:#4f46e5;"></i>
                                    Nombre de la Institución <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="institute_name" required
                                    placeholder="Ej: Hospital Central"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-diagram-3 mr-1" style="color:#4f46e5;"></i>
                                    Área del Hospital <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="institute_area" required
                                    placeholder="Ej: Central de Esterilización"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-signpost mr-1" style="color:#4f46e5;"></i>
                                    Dirección <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="institute_address" required
                                    placeholder="Ej: Av. Principal 123"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-building mr-1" style="color:#4f46e5;"></i>
                                    Ciudad <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="institute_city" required
                                    placeholder="Ej: Santiago"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-globe mr-1" style="color:#4f46e5;"></i>
                                    País <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="institute_country" required
                                    placeholder="Ej: Chile"
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
                        style="border-radius:8px;padding:9px 22px;font-weight:600;background:linear-gradient(135deg,#4f46e5,#3730a3);box-shadow:0 4px 12px rgba(79,70,229,0.35);border:none;">
                        <i class="bi bi-check-lg mr-2"></i> Registrar Institución
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
