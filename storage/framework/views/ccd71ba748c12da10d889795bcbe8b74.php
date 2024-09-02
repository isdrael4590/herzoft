<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Fecha Inicio <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Fecha Fin <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger mt-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Equipo</label>
                                    <select wire:model="machine_name" class="form-control" name="machine_name">
                                        <option value="">Seleccione el Equipo</option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = \Modules\Informat\Entities\Machine::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($machine->machine_name); ?>"><?php echo e($machine->machine_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4">
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

                            <div class="col-lg-4">
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
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm"
                                    role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Filtrar Reporte
                            </button>


                        </div>
                    </form>
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
                                <th>Validación Proceso</th>
                                <th>Validación Biológico</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $discharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discharge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(\Carbon\Carbon::parse($discharge->updated_at)->format('d M, Y')); ?></td>
                                    <td><?php echo e($discharge->reference); ?></td>
                                    <td><?php echo e($discharge->machine_name); ?></td>
                                    <td><?php echo e($discharge->lote_machine); ?></td>
                                    <td>
                                        <!--[if BLOCK]><![endif]--><?php if($discharge->status_cycle == 'Ciclo Falla'): ?>
                                            <span class="badge badge-info">
                                                <?php echo e($discharge->status_cycle); ?>

                                            </span>
                                        <?php elseif($discharge->status_cycle == 'Ciclo Aprobado'): ?>
                                            <span class="badge badge-primary">
                                                <?php echo e($discharge->status_cycle); ?>

                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>
                                    <td>
                                        <!--[if BLOCK]><![endif]--><?php if($discharge->validation_biologic == 'Falla'): ?>
                                            <span class="badge badge-info">
                                                <?php echo e($discharge->validation_biologic); ?>

                                            </span>
                                        <?php elseif($discharge->validation_biologic == 'Correcto'): ?>
                                            <span class="badge badge-primary">
                                                <?php echo e($discharge->validation_biologic); ?>

                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">Datos no Disponibles Descarga</span>
                                    </td>
                                </tr>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>
                    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['mt-3' => $discharges->hasPages()]); ?>">
                        <?php echo e($discharges->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/reports/discharges-report.blade.php ENDPATH**/ ?>