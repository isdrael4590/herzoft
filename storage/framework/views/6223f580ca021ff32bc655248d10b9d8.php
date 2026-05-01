<?php $__env->startSection('title', 'Stock - Preparación'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Preparación</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="bi bi-box-seam"></i> Gestión de Preparación
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="action-buttons mb-3">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?>
                                <a href="<?php echo e(route('preparations.index')); ?>" class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i>
                                    Preparación exclusivo
                                </a>



                                <a href="<?php echo e(route('preparationDetails.resetHistory')); ?>" class="btn btn-info">
                                    <i class="bi bi-clock-history"></i>
                                    Historial de Reseteos
                                </a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reset_preparations')): ?>
                                <!-- FORMULARIO SIMPLE DE RESET -->
                                <form id="resetForm" action="<?php echo e(route('preparationDetails.resetQuantities')); ?>" method="POST"
                                    style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <button type="button" class="btn btn-warning" id="resetQuantitiesBtn">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        Reiniciar Cantidades
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        


                        <div class="table-responsive">
                            <?php echo $dataTable->table(['class' => 'table table-hover table-striped align-middle']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <?php echo $dataTable->scripts(); ?>


    <script>
        $(document).ready(function() {
            console.log('Script cargado correctamente');

            // VERSIÓN SIMPLIFICADA PARA DIAGNÓSTICO
            const resetBtn = document.getElementById('resetQuantitiesBtn');
            const resetForm = document.getElementById('resetForm');

            if (resetBtn && resetForm) {
                console.log('Botón y formulario encontrados');
                console.log('Action del formulario:', resetForm.action);

                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Click en botón detectado');

                    // Confirmación simple con confirm() nativo
                    if (confirm('¿Está seguro de reiniciar las cantidades?')) {
                        console.log('Usuario confirmó, enviando formulario...');
                        resetForm.submit();
                    } else {
                        console.log('Usuario canceló');
                    }
                });
            } else {
                console.error('No se encontró el botón o el formulario');
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Preparation/Resources/views/preparationDetails/index.blade.php ENDPATH**/ ?>