<?php $__env->startSection('title', 'Descarga de Ciclos'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Descarga de Ciclos</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">

        
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                    style="width:48px;height:48px;background:linear-gradient(135deg,#8b5cf6,#7c3aed);">
                    <i class="bi bi-arrow-down-circle text-white" style="font-size:1.4rem;"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-weight-bold text-dark">Descarga de Ciclos</h4>
                    <small class="text-muted">Gestión y liberación de ciclos de esterilización</small>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_discharge_Details')): ?>
                <a href="<?php echo e(route('dischargeDetails.index')); ?>"
                    class="btn d-flex align-items-center text-white"
                    style="border-radius:8px;padding:10px 20px;font-weight:600;box-shadow:0 4px 12px rgba(139,92,246,0.35);background:linear-gradient(135deg,#8b5cf6,#7c3aed);border:none;">
                    <i class="bi bi-list-ul mr-2"></i> Instrumental Listado
                </a>
            <?php endif; ?>
        </div>

        
        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
            <div class="card-header border-0 d-flex align-items-center justify-content-between"
                style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-table mr-2" style="font-size:1.1rem;color:#8b5cf6;"></i>
                    <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">REGISTRO DE CICLOS</span>
                </div>
                <span class="badge" style="font-size:.75rem;padding:5px 10px;border-radius:20px;background:rgba(139,92,246,0.12);color:#7c3aed;">
                    Tabla en tiempo real
                </span>
            </div>
            <div class="card-body" style="padding:24px;">

                
                <div class="d-flex align-items-center mb-3" style="gap:10px;">
                    <i class="bi bi-funnel" style="font-size:1rem;color:#8b5cf6;"></i>
                    <span class="text-muted font-weight-semibold" style="font-size:.85rem;white-space:nowrap;">Filtrar por estado:</span>
                    <select id="filter-status" class="form-control form-control-sm" style="max-width:200px;">
                        <option value="">Todos</option>
                        <option value="En Curso">En Curso</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Ciclo Aprobado">Ciclo Aprobado</option>
                        <option value="Ciclo Falla">Ciclo Falla</option>
                    </select>
                </div>

                <div class="table-responsive">
                    <?php echo $dataTable->table(['class' => 'table table-hover table-bordered align-middle']); ?>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <?php echo $dataTable->scripts(); ?>

    <script>
        $(document).ready(function () {
            $('#filter-status').on('change', function () {
                window.LaravelDataTables['discharges-table']
                    .column(3)
                    .search($(this).val())
                    .draw();
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Discharge/Resources/views/discharges/index.blade.php ENDPATH**/ ?>