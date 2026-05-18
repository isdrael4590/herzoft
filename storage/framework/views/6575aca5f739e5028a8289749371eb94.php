<?php $__env->startSection('title', 'Editar Usuario'); ?>

<?php $__env->startSection('third_party_stylesheets'); ?>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid mb-4">

        <?php echo $__env->make('utils.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                style="width:48px;height:48px;background:linear-gradient(135deg,#f59e0b,#d97706);">
                <i class="bi bi-person-gear text-white" style="font-size:1.4rem;"></i>
            </div>
            <div>
                <h4 class="mb-0 font-weight-bold text-dark">Editar Usuario</h4>
                <small class="text-muted"><?php echo e($user->name); ?> &mdash; <?php echo e($user->email); ?></small>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->must_change_password): ?>
            <div class="alert alert-warning d-flex align-items-center mb-4" style="border-radius:10px;">
                <i class="bi bi-exclamation-triangle-fill mr-2" style="font-size:1.2rem;"></i>
                <span>Este usuario tiene una <strong>contraseña temporal</strong> asignada y deberá cambiarla en su próximo inicio de sesión.</span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form id="edit-user-form" action="<?php echo e(route('users.update', $user->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="card border-0 mb-4" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                            <i class="bi bi-person-lines-fill text-warning mr-2" style="font-size:1.1rem;"></i>
                            <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">DATOS DEL USUARIO</span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <div class="form-row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Nombres Completos <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text" name="name" required
                                            style="border-radius:8px;border:1px solid #e2e8f0;"
                                            value="<?php echo e($user->name); ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                            Usuario <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control" type="text" name="username" required
                                            style="border-radius:8px;border:1px solid #e2e8f0;"
                                            value="<?php echo e($user->username); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Rol <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="role" id="role" required
                                    style="border-radius:8px;border:1px solid #e2e8f0;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Spatie\Permission\Models\Role::where('name', '!=', 'Super Admin')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($user->hasRole($role->name) ? 'selected' : ''); ?> value="<?php echo e($role->name); ?>">
                                            <?php echo e($role->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group mb-0">
                                <label class="font-weight-semibold text-secondary" style="font-size:.85rem;">
                                    Estado <span class="text-danger">*</span>
                                </label>
                                <select class="form-control" name="is_active" id="is_active" required
                                    style="border-radius:8px;border:1px solid #e2e8f0;">
                                    <option value="1" <?php echo e($user->is_active == 1 ? 'selected' : ''); ?>>Activo</option>
                                    <option value="2" <?php echo e($user->is_active == 2 ? 'selected' : ''); ?>>Desactivado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_user_management')): ?>
                        <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                            <div class="card-header border-0 d-flex align-items-center"
                                style="background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:12px 12px 0 0;padding:16px 24px;">
                                <i class="bi bi-key-fill text-warning mr-2" style="font-size:1.1rem;"></i>
                                <span class="font-weight-semibold" style="font-size:.9rem;letter-spacing:.3px;color:#92400e;">REINICIO DE CONTRASEÑA</span>
                            </div>
                            <div class="card-body" style="padding:24px;">
                                <p class="text-muted mb-3" style="font-size:.9rem;">
                                    Reinicia la contraseña del usuario a la clave temporal
                                    <code class="px-2 py-1 rounded" style="background:#f1f5f9;color:#4f46e5;font-size:.9rem;">Admin1234!</code>.
                                    El usuario deberá cambiarla al iniciar sesión.
                                </p>
                                <form action="<?php echo e(route('users.reset-password', $user->id)); ?>" method="POST"
                                    onsubmit="return confirm('¿Reiniciar la contraseña de <?php echo e(addslashes($user->name)); ?> a la clave temporal?')">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit"
                                        class="btn d-inline-flex align-items-center"
                                        style="border-radius:8px;padding:9px 20px;font-weight:600;background:linear-gradient(135deg,#f59e0b,#d97706);border:none;color:#fff;box-shadow:0 4px 12px rgba(245,158,11,0.35);">
                                        <i class="bi bi-arrow-clockwise mr-2"></i> Reiniciar Contraseña
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0" style="border-radius:12px;box-shadow:0 2px 20px rgba(0,0,0,0.08);">
                        <div class="card-header border-0 d-flex align-items-center"
                            style="background:linear-gradient(135deg,#f8fafc,#f1f5f9);border-radius:12px 12px 0 0;padding:16px 24px;">
                            <i class="bi bi-image text-warning mr-2" style="font-size:1.1rem;"></i>
                            <span class="font-weight-semibold text-secondary" style="font-size:.9rem;letter-spacing:.3px;">FOTO DE PERFIL</span>
                        </div>
                        <div class="card-body" style="padding:24px;">
                            <img style="width:80px;height:80px;"
                                class="d-block mx-auto img-thumbnail img-fluid rounded-circle mb-3"
                                src="<?php echo e($user->getFirstMediaUrl('avatars')); ?>"
                                alt="Foto de perfil">
                            <div class="form-group mb-0">
                                <input id="image" type="file" name="image" data-max-file-size="500KB">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" form="edit-user-form"
                            class="btn btn-block d-flex align-items-center justify-content-center"
                            style="border-radius:8px;padding:12px 20px;font-weight:600;box-shadow:0 4px 12px rgba(245,158,11,0.35);background:linear-gradient(135deg,#f59e0b,#d97706);border:none;color:#fff;">
                            <i class="bi bi-check-lg mr-2"></i> Guardar Cambios
                        </button>
                        <a href="<?php echo e(route('users.index')); ?>"
                            class="btn btn-block btn-outline-secondary mt-2"
                            style="border-radius:8px;padding:12px 20px;font-weight:600;">
                            <i class="bi bi-arrow-left mr-2"></i> Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('third_party_scripts'); ?>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_scripts'); ?>
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const fileElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(fileElement, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        FilePond.setOptions({
            server: {
                url: "<?php echo e(route('filepond.upload')); ?>",
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/User/Resources/views/users/edit.blade.php ENDPATH**/ ?>