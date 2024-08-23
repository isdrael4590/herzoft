<?php
    $Machine_max_id = \Modules\Informat\Entities\Machine::max('id') + 1;
    $machine_code = 'Eq_' . str_pad($Machine_max_id, 2, '0', STR_PAD_LEFT);
?>
<div class="modal fade" id="MachineCreateModal" tabindex="-1" role="dialog" aria-labelledby="MachineCreateModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MachineCreateModalLabel">Crear Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e(route('machine.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_code">Código Equipo <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="machine_code" required
                            value="<?php echo e($machine_code); ?>">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_name">Nombre del Equipo <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="machine_name" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_model">Modelo Equipo <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="machine_model" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_type">Tipo de Equipo <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="machine_type" id="machine_type" required>
                                <option value="" selected disabled>Selección Tipo de Equipo
                                </option>
                                <option value="Autoclave">Autoclave</option>
                                <option value="Peroxido">Peroxido</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_identificator">Indicador de Equipo <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                            <select class="form-control" name="machine_identificator" id="machine_identificator"
                                required>
                                <option value="" selected disabled>Selección Contador
                                </option>
                                <option value="Autoclave1">Autoclave1</option>
                                <option value="Autoclave2">Autoclave2</option>
                                <option value="Peroxido1">Peroxido1</option>
                                <option value="Peroxido2">Peroxido2</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_serial">Serie del Equipo <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="machine_serial" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_factory">Marca del esterilizador <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="machine_factory" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="machine_country">País de fabricación <span
                                class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="machine_country" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear <i class="bi bi-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Modules/Informat/Resources/views/includes/machine-modal.blade.php ENDPATH**/ ?>