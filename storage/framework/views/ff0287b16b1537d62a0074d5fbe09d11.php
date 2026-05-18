<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ingresar | <?php echo e(config('app.name')); ?></title>
    <link rel="icon" href="<?php echo e(settings()->getFirstMediaUrl('settings')); ?>">
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        body.login-page {
            min-height: 100vh;
            margin: 0;
            background: #f0f4f8;
            display: flex;
            align-items: stretch;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Panel izquierdo */
        .login-brand {
            flex: 1;
            background: linear-gradient(145deg, #1d4ed8 0%, #1e40af 50%, #1e3a8a 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .login-brand::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            top: -100px;
            right: -100px;
        }

        .login-brand::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            bottom: -80px;
            left: -80px;
        }

        .login-brand-content {
            position: relative;
            z-index: 1;
            text-align: center;
            color: #fff;
        }

        .login-brand-logo {
            max-width: 180px;
            max-height: 80px;
            object-fit: contain;
            margin-bottom: 2rem;
            border-radius: 8px;
            padding: 6px;
            background: rgba(255,255,255,0.12);
        }

        .login-brand-logo-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: #fff;
        }

        .login-brand h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            letter-spacing: -0.5px;
        }

        .login-brand p {
            font-size: 1rem;
            opacity: 0.8;
            max-width: 300px;
            line-height: 1.6;
        }

        .login-brand-divider {
            width: 50px;
            height: 3px;
            background: rgba(255,255,255,0.4);
            border-radius: 2px;
            margin: 1.5rem auto;
        }

        /* Panel derecho */
        .login-form-panel {
            width: 480px;
            min-width: 480px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 3rem;
            box-shadow: -4px 0 30px rgba(0,0,0,0.08);
        }

        .login-form-inner {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-heading {
            margin-bottom: 2rem;
        }

        .login-heading h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.25rem;
        }

        .login-heading p {
            color: #64748b;
            font-size: 0.95rem;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        .login-input-group {
            position: relative;
            margin-bottom: 1.25rem;
        }

        .login-input-group .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            pointer-events: none;
        }

        .login-input-group input {
            width: 100%;
            padding: 0.7rem 1rem 0.7rem 2.75rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #1e293b;
            background: #f8fafc;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .login-input-group input:focus {
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }

        .login-input-group input.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: #ef4444;
            margin-top: 0.3rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity 0.2s, transform 0.1s;
            box-shadow: 0 4px 12px rgba(37,99,235,0.3);
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            opacity: 0.93;
        }

        .btn-login:active {
            transform: scale(0.99);
        }

        .btn-login:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .forgot-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #3b82f6;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .login-footer {
            text-align: center;
            font-size: 0.78rem;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 1.5rem;
            margin-top: 2rem;
        }

        .login-footer a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        /* Alertas */
        .alert-licence {
            background: #fffbeb;
            border: 1px solid #fcd34d;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: #92400e;
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .alert-deactivated {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: #991b1b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-brand {
                display: none;
            }
            .login-form-panel {
                width: 100%;
                min-width: 0;
                padding: 2rem 1.5rem;
                box-shadow: none;
            }
        }
    </style>
</head>

<body class="login-page">
    <?php
        $licence = \Modules\Setting\Entities\Licence::first();
        $isExpired = $licence && $licence->license_expiration_date && $licence->license_expiration_date->isPast();
    ?>

    <div class="login-wrapper">

        <!-- Panel izquierdo: branding -->
        <div class="login-brand">
            <div class="login-brand-content">
                <?php $logoUrl = settings()->getFirstMediaUrl('settings'); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logoUrl): ?>
                    <img src="<?php echo e($logoUrl); ?>" alt="Logo" class="login-brand-logo"
                         onerror="this.style.display='none';document.getElementById('logo-placeholder').style.display='flex';">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div id="logo-placeholder" class="login-brand-logo-placeholder" style="<?php echo e($logoUrl ? 'display:none' : ''); ?>">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h2>Sistema de Trazabilidad CEYE </h2>
                <div class="login-brand-divider"></div>
                <p>Control y seguimiento integral de procesos de esterilización</p>
            </div>
        </div>

        <!-- Panel derecho: formulario -->
        <div class="login-form-panel">
            <div class="login-form-inner">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isExpired): ?>
                    <div class="alert-licence">
                        <i class="bi bi-exclamation-triangle-fill" style="margin-top:1px;flex-shrink:0;"></i>
                        <span>La licencia del sistema está vencida. <strong>Contacte al administrador</strong> para renovarla.</span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Session::has('account_deactivated')): ?>
                    <div class="alert-deactivated">
                        <i class="bi bi-x-circle-fill"></i>
                        <?php echo e(Session::get('account_deactivated')); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Logo visible solo en móvil cuando se oculta el panel izquierdo -->
                <div class="text-center mb-4 d-md-none">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logoUrl): ?>
                        <img src="<?php echo e($logoUrl); ?>" alt="Logo" style="max-height:60px;max-width:180px;object-fit:contain;">
                    <?php else: ?>
                        <div style="width:64px;height:64px;border-radius:50%;background:#1d4ed8;display:inline-flex;align-items:center;justify-content:center;">
                            <i class="bi bi-box-seam" style="color:#fff;font-size:1.5rem;"></i>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="login-heading">
                    <h1>Bienvenido</h1>
                    <p>Ingresa tus credenciales para continuar</p>
                </div>

                <form id="login" method="post" action="<?php echo e(url('/login')); ?>">
                    <?php echo csrf_field(); ?>

                    <label class="form-label" for="login">Usuario o Correo</label>
                    <div class="login-input-group">
                        <i class="bi bi-person input-icon"></i>
                        <input id="login" type="text" name="login"
                            class="<?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('login')); ?>"
                            placeholder="usuario o correo electrónico"
                            autofocus autocomplete="username">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <label class="form-label" for="password">Contraseña</label>
                    <div class="login-input-group">
                        <i class="bi bi-lock input-icon"></i>
                        <input id="password" type="password" name="password"
                            class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="••••••••"
                            style="padding-right:2.75rem;">
                        <button type="button" id="toggle-password"
                            style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;padding:0;cursor:pointer;color:#94a3b8;font-size:1rem;line-height:1;"
                            tabindex="-1" aria-label="Mostrar contraseña">
                            <i class="bi bi-eye" id="eye-icon"></i>
                        </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <button id="submit" class="btn-login" type="submit">
                        Ingresar
                        <div id="spinner" class="spinner-border" role="status"
                            style="height:18px;width:18px;border-width:2px;display:none;">
                            <span class="sr-only">Cargando...</span>
                        </div>
                    </button>
                </form>

                <a class="forgot-link" href="<?php echo e(route('password.request')); ?>">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <footer class="login-footer">
                Desarrollado por
                <a href="http://www.herzgroup.net/" target="_blank"><?php echo e(Settings()->company_name); ?></a>
                &nbsp;·&nbsp;
                Derechos contratados por
                <a href="http://www.alem.com.ec/" target="_blank">Alem Cia. Ltda.</a>
                <br>
                HerzTrace <?php echo e(date('Y')); ?> &nbsp;·&nbsp; Versión <strong>2.0</strong>
            </footer>
        </div>
    </div>

    <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });

        const loginForm = document.getElementById('login');
        const submitBtn = document.getElementById('submit');
        const usernameInput = document.getElementById('login');
        const passwordInput = document.getElementById('password');
        const spinner = document.getElementById('spinner');

        loginForm.addEventListener('submit', () => {
            submitBtn.disabled = true;
            usernameInput.readOnly = true;
            passwordInput.readOnly = true;
            spinner.style.display = 'inline-block';
        });

        setTimeout(() => {
            submitBtn.disabled = false;
            usernameInput.readOnly = false;
            passwordInput.readOnly = false;
            spinner.style.display = 'none';
        }, 3000);
    </script>
</body>

</html>
<?php /**PATH /var/www/html/resources/views/auth/login.blade.php ENDPATH**/ ?>