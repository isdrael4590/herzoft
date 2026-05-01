<?php $__env->startSection('title', 'Registrar Descarga de Lavado'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lavados.index')); ?>">Lavados</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('lavados.show', $lavado->id)); ?>"><?php echo e($lavado->reference); ?></a></li>
        <li class="breadcrumb-item active">Ciclo a Enviar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <i class="bi bi-droplet-half text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark">Ciclo a Enviar</h5>
                    <small class="text-muted">Proveniente de Lavado <strong><?php echo e($lavado->reference); ?></strong></small>
                </div>
            </div>
            <a href="<?php echo e(route('lavados.show', $lavado->id)); ?>" class="btn btn-outline-secondary d-flex align-items-center"
                style="border-radius:8px;padding:9px 18px;font-weight:600;">
                <i class="bi bi-arrow-left mr-2"></i> Volver
            </a>
        </div>

        
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-list-ul text-info mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Instrumental del Lavado
                </span>
                <span class="badge badge-info ml-2"><?php echo e($lavado->lavadoDetalles->count()); ?> ítem(s)</span>
            </div>
            <div class="card-body" style="padding:20px 24px;">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead style="background:#f8fafc;">
                            <tr>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Código</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Nombre</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Cantidad</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Paciente</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Info</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Área</th>
                                <th style="font-size:.8rem;font-weight:700;color:#64748b;">Proceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $lavado->lavadoDetalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td style="font-size:.85rem;"><span class="badge badge-light border"><?php echo e($det->product_code); ?></span></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_name); ?></td>
                                    <td style="font-size:.85rem;" class="text-center">
                                        <span class="badge badge-secondary"><?php echo e($det->product_quantity); ?></span>
                                    </td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_patient ?? '-'); ?></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_info ?? '-'); ?></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_area ?? '-'); ?></td>
                                    <td style="font-size:.85rem;"><?php echo e($det->product_type_process ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted" style="font-size:.85rem;">Sin ítems registrados</td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:14px 24px;border-left:4px solid #0ea5e9;">
                <i class="bi bi-droplet-half text-info mr-2"></i>
                <span class="font-weight-bold text-secondary"
                    style="font-size:.85rem;letter-spacing:.5px;text-transform:uppercase;">
                    Datos de la Descarga
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form id="descarga-form" action="<?php echo e(route('descarga-lavado.store')); ?>" method="POST"
                    onsubmit="return handleFormSubmit(event)">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="lavado_id" value="<?php echo e($lavado->id); ?>">
                    <input type="hidden" name="status" value="En Curso">

                    
                    <div class="form-row mb-3">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-person-badge text-info mr-1"></i>
                                    Operador <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" type="text" name="operator"
                                    value="<?php echo e(old('operator', $lavado->operator)); ?>" required readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-cpu text-info mr-1"></i>
                                    Equipo Lavadora
                                </label>
                                <select class="form-control" name="machine_name"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;" readonly>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($machine->machine_type == 'Lavadora'): ?>
                                            <option value="<?php echo e($machine->machine_name); ?>"
                                                <?php echo e(old('machine_name', $lavado->equipo) === $machine->machine_name ? 'selected' : ''); ?>>
                                                <?php echo e($machine->machine_name); ?>

                                            </option>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-hash text-info mr-1"></i>
                                    Lote
                                </label>
                                <input type="text" name="lote" class="form-control"
                                    value="<?php echo e(old('lote', $lavado->lote)); ?>" required readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-list-check text-info mr-1"></i>
                                    Programa de Lavado
                                </label>
                                <select class="form-control" name="type_program"
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;" readonly>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Modules\Informat\Entities\Proceso::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proceso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($proceso->proceso_type == 'LAVADO'): ?>
                                            <option value="<?php echo e($proceso->proceso_name); ?>"
                                                <?php echo e(old('type_program', $lavado->programa_lavado) === $proceso->proceso_name ? 'selected' : ''); ?>>
                                                <?php echo e($proceso->proceso_name); ?>

                                            </option>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-thermometer-half text-info mr-1"></i>
                                    Temperatura (°C)
                                </label>
                                <input type="number" step="0.1" name="temperatura" class="form-control"
                                    value="<?php echo e(old('temperatura', $lavado->temperatura)); ?>" required
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;">
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-row mt-3">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-toggle-on text-info mr-1"></i>
                                    Estado Indicador <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="status_indicador"
                                    value="Sin Validar" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-check2-circle text-info mr-1"></i>
                                    Estado del Ciclo <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="status_ciclo"
                                    value="En Curso" readonly
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;background:#f8fafc;cursor:not-allowed;">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-dark font-weight-semibold" style="font-size:.875rem;">
                                    <i class="bi bi-chat-text text-secondary mr-1"></i>
                                    Nota (opcional)
                                </label>
                                <textarea name="note" rows="4" class="form-control" maxlength="400"
                                    onkeyup="updateCounter()"
                                    placeholder="Observaciones adicionales..."
                                    style="border-radius:8px;border-color:#e2e8f0;padding:10px 14px;resize:vertical;"><?php echo e(old('note')); ?></textarea>
                                <small class="text-muted">
                                    <span id="charCount"><?php echo e(strlen(old('note', ''))); ?></span>/400 caracteres
                                </small>
                            </div>
                        </div>
                    </div>

                    
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div id="loading-indicator" class="d-none d-flex align-items-center text-info">
                            <div class="spinner-border spinner-border-sm mr-2" role="status">
                                <span class="sr-only">Procesando...</span>
                            </div>
                            <span style="font-size:.875rem;">Guardando registro...</span>
                        </div>
                        <div class="d-flex ml-auto" style="gap:10px;">
                            <a href="<?php echo e(route('lavados.show', $lavado->id)); ?>"
                                class="btn btn-outline-secondary d-flex align-items-center"
                                style="border-radius:8px;padding:10px 20px;font-weight:600;">
                                <i class="bi bi-x-circle mr-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn d-flex align-items-center text-white" id="submit-btn"
                                style="border-radius:8px;padding:10px 24px;font-weight:600;background:linear-gradient(135deg,#0ea5e9,#0284c7);border:none;box-shadow:0 4px 12px rgba(14,165,233,0.35);">
                                <span id="submit-text">Enviar Ciclo</span>
                                <i class="bi bi-check-lg ml-2" id="submit-icon"></i>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        let isSubmitting = false;

        function updateCounter() {
            const textarea = document.querySelector('textarea[name="note"]');
            const counter = document.getElementById('charCount');
            if (textarea && counter) counter.textContent = textarea.value.length;
        }

        function handleFormSubmit(event) {
            if (isSubmitting) { event.preventDefault(); return false; }
            isSubmitting = true;
            const btn = document.getElementById('submit-btn');
            document.getElementById('submit-text').textContent = 'Procesando...';
            document.getElementById('submit-icon').className = 'bi bi-hourglass-split ml-2';
            document.getElementById('loading-indicator').classList.remove('d-none');
            btn.disabled = true;
            setTimeout(() => { isSubmitting = false; btn.disabled = false; }, 10000);
            return true;
        }

        document.addEventListener('DOMContentLoaded', updateCounter);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Lavado/Resources/views/descarga-lavado/create.blade.php ENDPATH**/ ?>