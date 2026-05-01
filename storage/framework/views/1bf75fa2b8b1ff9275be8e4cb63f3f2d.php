<?php $__env->startSection('title', 'Configuración de Licencia'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Configuración de Licencia</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <style>
        .license-card {
            border-left: 4px solid #667eea;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            transition: all 0.3s ease;
        }

        .license-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .license-status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .license-info-box {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .license-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Configuración de Licencia</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card license-card">
                    <?php if($licence->isExpired()): ?>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">
                                <i class="fas fa-exclamation-triangle"></i> ¡Licencia Expirada!
                            </h4>
                            <p>La licencia expiró el
                                <strong><?php echo e($licence->license_expiration_date->format('d/m/Y')); ?></strong></p>
                            <hr>
                            <p class="mb-0">
                                <i class="fas fa-users-slash"></i>
                                <strong><?php echo e($blockedUsersCount); ?></strong> usuarios están actualmente bloqueados y no pueden
                                acceder al sistema.
                            </p>
                            <p class="mb-0 mt-2">
                                Solo administradores y super administradores pueden acceder con la licencia expirada.
                            </p>
                        </div>
                    <?php endif; ?>
                    <div class="card-header bg-transparent border-bottom-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-key text-primary"></i> Gestión de Licencia
                            </h5>
                            <?php if($licence && $licence->license_expiration_date): ?>
                                <span class="license-status-badge bg-<?php echo e($licence->status_color); ?> text-white">
                                    <?php echo e($licence->status_text); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(route('settings.licence.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="license_expiration_date">
                                            <i class="fas fa-calendar-alt"></i> Fecha de Vencimiento
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date"
                                            class="form-control form-control-lg <?php $__errorArgs = ['license_expiration_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="license_expiration_date" name="license_expiration_date"
                                            value="<?php echo e(old('license_expiration_date', $licence && $licence->license_expiration_date ? $licence->license_expiration_date->format('Y-m-d') : '')); ?>"
                                            min="<?php echo e(now()->addDay()->format('Y-m-d')); ?>" required>
                                        <?php $__errorArgs = ['license_expiration_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <small class="form-text text-muted">
                                            Seleccione la fecha en que vence la licencia del sistema
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                id="license_notification_enabled" name="license_notification_enabled"
                                                value="1"
                                                <?php echo e(old('license_notification_enabled', $licence && $licence->license_notification_enabled ? true : false) ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="license_notification_enabled">
                                                <i class="fas fa-bell"></i> Mostrar notificación de vencimiento
                                            </label>
                                        </div>
                                        <small class="form-text text-muted">
                                            La notificación aparecerá en la parte inferior cuando falten 30 días o menos
                                        </small>
                                    </div>

                                    <hr class="my-4">

                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save"></i> Guardar Configuración
                                        </button>
                                        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary btn-lg ml-2">
                                            <i class="fas fa-arrow-left"></i> Volver
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="license-info-box">
                                        <?php if($licence && $licence->license_expiration_date): ?>
                                            <?php
                                                $icons = [
                                                    'expired' => '🔴',
                                                    'critical' => '⚠️',
                                                    'warning' => '⚡',
                                                    'active' => '✅',
                                                ];
                                            ?>
                                            <div class="license-icon"><?php echo e($icons[$licence->status] ?? '📋'); ?></div>

                                            <h2 class="mb-2 text-<?php echo e($licence->status_color); ?>">
                                                <?php if($licence->days_remaining < 0): ?>
                                                    Expirada
                                                <?php else: ?>
                                                    <?php echo e($licence->days_remaining); ?>

                                                    <small
                                                        style="font-size: 0.5em;"><?php echo e($licence->days_remaining == 1 ? 'día' : 'días'); ?></small>
                                                <?php endif; ?>
                                            </h2>

                                            <p class="mb-2 text-muted">
                                                <i class="far fa-calendar"></i>
                                                Vence:
                                                <strong><?php echo e($licence->license_expiration_date->format('d/m/Y')); ?></strong>
                                            </p>

                                            <p class="mb-0 text-muted small">
                                                <i class="far fa-clock"></i>
                                                <?php echo e($licence->license_expiration_date->diffForHumans()); ?>

                                            </p>

                                            <?php if($licence->days_remaining <= 15 && $licence->days_remaining >= 0): ?>
                                                <div class="alert alert-<?php echo e($licence->status_color); ?> mt-3 mb-0 py-2">
                                                    <small>
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                        <?php if($licence->days_remaining <= 7): ?>
                                                            ¡Renueve su licencia urgentemente!
                                                        <?php else: ?>
                                                            Considere renovar su licencia pronto
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="license-icon">⚙️</div>
                                            <h4 class="text-muted mb-3">Sin configurar</h4>
                                            <p class="text-muted small">
                                                Configure la fecha de vencimiento de su licencia para activar las
                                                notificaciones del sistema
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        document.getElementById('license_expiration_date').addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            selectedDate.setHours(0, 0, 0, 0);

            const diffTime = selectedDate - today;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 0) {
                alert('⚠️ La fecha seleccionada ya pasó. Por favor, seleccione una fecha futura.');
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Setting/Resources/views/licence/index.blade.php ENDPATH**/ ?>