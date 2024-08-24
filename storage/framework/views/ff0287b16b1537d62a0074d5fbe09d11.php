<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Ingresar | <?php echo e(config('app.name')); ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('images/LOGOHERZ.jpg')); ?>">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="c-app flex-row align-items-center">
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-center">
            
                <img width="300" src="<?php echo e(URL::to('images/LOGOHERZ.jpg')); ?>" alt="Logo">

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <?php if(Session::has('account_deactivated')): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo e(Session::get('account_deactivated')); ?>

                </div>
            <?php endif; ?>
            <div class="card p-4 border-0 shadow-sm">
                <div class="card-body">
                    <form id="login" method="post" action="<?php echo e(url('/login')); ?>">
                        <?php echo csrf_field(); ?>
                        <h1>Ingresar</h1>
                        <p class="text-muted">Ingresar a su cuenta</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="bi bi-person"></i>
                                    </span>
                            </div>
                            <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="email" value="<?php echo e(old('email')); ?>"
                                   placeholder="Email">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="bi bi-lock"></i>
                                    </span>
                            </div>
                            <input id="password" type="password"
                                   class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   placeholder="Password" name="password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button id="submit" class="btn btn-primary px-4 d-flex align-items-center"
                                        type="submit">
                                    INGRESAR
                                    <div id="spinner" class="spinner-border text-info" role="status"
                                         style="height: 20px;width: 20px;margin-left: 5px;display: none;">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </button>
                            </div>
                            <div class="col-8 text-right">
                                <a class="btn btn-link px-0" href="<?php echo e(route('password.request')); ?>">
                                    Olvido su contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center mt-10 lead">
               Desarrollado por 
                <a href="http://www.herzgroup.net/" class="font-weight-bold text-primary">Herz Group</a>
       <br>
                Derechos Contratados por 
                 <a href="http://www.alem.com.ec/" class="font-weight-bold text-primary">Alem Cia. Ltda.</a>
             </p>
        </div>
    </div>
    <footer class="c-footer">
        <div>herZoft <?php echo e(date('Y')); ?> || Todos los derechos son reservados con <strong><a href="http://www.herzgroup.net/">Herz Group</a></strong></div>
    
        <div class="mfs-auto d-md-down-none">Version <strong class="text-danger">1.0</strong></div>
    </footer>
</div>

<!-- CoreUI -->
<script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
<script>
    let login = document.getElementById('login');
    let submit = document.getElementById('submit');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let spinner = document.getElementById('spinner')

    login.addEventListener('submit', (e) => {
        submit.disabled = true;
        email.readonly = true;
        password.readonly = true;

        spinner.style.display = 'block';

        login.submit();
    });

    setTimeout(() => {
        submit.disabled = false;
        email.readonly = false;
        password.readonly = false;

        spinner.style.display = 'none';
    }, 3000);
</script>

</body>

</html>
<?php /**PATH /var/www/html/resources/views/auth/login.blade.php ENDPATH**/ ?>