<?php
    use Modules\Setting\Entities\Licence;
    $licence = Licence::first();
    $showNotification = $licence && $licence->shouldShowNotification();
    $daysRemaining = $showNotification ? $licence->days_remaining : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?> || <?php echo e(config('app.name')); ?></title>
    <meta content="HerzTrace" name="author">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(settings()->getFirstMediaUrl('settings')); ?>">

    <?php echo $__env->make('includes.main-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- stack css -->
    <style>
        /* ═══════════════════════════════════════════════════════════
           SIDEBAR MODERNO — HERZTRACE
           ═══════════════════════════════════════════════════════════ */

        /* ── Fondo principal ──────────────────────────────────────── */
        .c-sidebar {
            background: linear-gradient(160deg, #0f2554 0%, #1a3a7c 50%, #122a6a 100%) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.35) !important;
        }

        /* ── Brand / logo ─────────────────────────────────────────── */
        .c-sidebar-brand {
            background: rgba(255, 255, 255, 0.04) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            padding: 18px 20px !important;
        }

        /* ── Títulos de sección ───────────────────────────────────── */
        .c-sidebar-nav-title {
            font-size: 10.5px !important;
            font-weight: 700 !important;
            letter-spacing: 2px !important;
            text-transform: uppercase !important;
            padding: 18px 20px 7px !important;
            margin-top: 2px !important;
            opacity: 1 !important;
            color: #5b9bd5 !important;
            border-top: 1px solid rgba(0, 212, 245, 0.12) !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }

        .c-sidebar-nav-title::before {
            content: '';
            display: inline-block;
            width: 14px;
            height: 2px;
            border-radius: 2px;
            background: currentColor;
            opacity: 0.7;
            flex-shrink: 0;
        }

        /* Color por sección — paleta logo HerzTrace */
        .nav-title--dirty   { color: #e86060 !important; }   /* rojo Herz */
        .nav-title--zne     { color: #4da8f5 !important; }   /* azul Trace */
        .nav-title--esteril { color: #34d399 !important; }   /* verde estéril */
        .nav-title--almacen { color: #a78bfa !important; }   /* violeta */
        .nav-title--reports { color: #00d4f5 !important; }   /* cyan escudo */
        .nav-title--db      { color: #818cf8 !important; }   /* índigo */
        .nav-title--config  { color: #fbbf24 !important; }   /* ámbar */

        /* ── Links de nivel 1 ─────────────────────────────────────── */
        .c-sidebar .c-sidebar-nav-link,
        .c-sidebar .c-sidebar-nav-dropdown-toggle {
            color: #c4d8f5 !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
            padding: 10px 20px !important;
            border-left: 3px solid transparent !important;
            border-radius: 0 !important;
            transition: color 0.18s ease, background 0.18s ease, border-color 0.18s ease !important;
            letter-spacing: 0.2px;
        }

        .c-sidebar .c-sidebar-nav-link:hover,
        .c-sidebar .c-sidebar-nav-dropdown-toggle:hover {
            color: #ffffff !important;
            background: rgba(0, 212, 245, 0.07) !important;
            border-left-color: #00d4f5 !important;
        }

        /* Estado activo — cyan del logo */
        .c-sidebar .c-sidebar-nav-link.c-active {
            color: #ffffff !important;
            background: rgba(0, 212, 245, 0.12) !important;
            border-left: 3px solid #00d4f5 !important;
            font-weight: 600 !important;
        }

        /* Dropdown abierto */
        .c-sidebar .c-sidebar-nav-dropdown.c-show > .c-sidebar-nav-dropdown-toggle {
            color: #ffffff !important;
            background: rgba(0, 212, 245, 0.07) !important;
            border-left-color: #00d4f5 !important;
        }

        /* ── Submenú ──────────────────────────────────────────────── */
        .c-sidebar .c-sidebar-nav-dropdown-items {
            background: rgba(0, 0, 0, 0.15) !important;
        }

        .c-sidebar .c-sidebar-nav-dropdown-items .c-sidebar-nav-link {
            font-size: 13px !important;
            padding: 8px 20px 8px 42px !important;
            color: #8ab0d8 !important;
            border-left: 3px solid transparent !important;
            font-weight: 400 !important;
        }

        .c-sidebar .c-sidebar-nav-dropdown-items .c-sidebar-nav-link:hover {
            color: #e8f0fb !important;
            background: rgba(0, 212, 245, 0.06) !important;
            border-left-color: #00d4f5 !important;
        }

        .c-sidebar .c-sidebar-nav-dropdown-items .c-sidebar-nav-link.c-active {
            color: #00d4f5 !important;
            background: rgba(0, 212, 245, 0.1) !important;
            border-left: 3px solid #00d4f5 !important;
            font-weight: 600 !important;
        }

        /* ── Iconos ───────────────────────────────────────────────── */
        .c-sidebar .c-sidebar-nav-icon {
            color: #5b86be !important;
            font-size: 15px !important;
            min-width: 22px !important;
            transition: color 0.18s ease !important;
        }

        .c-sidebar .c-sidebar-nav-link:hover .c-sidebar-nav-icon,
        .c-sidebar .c-sidebar-nav-dropdown-toggle:hover .c-sidebar-nav-icon,
        .c-sidebar .c-sidebar-nav-dropdown.c-show > .c-sidebar-nav-dropdown-toggle .c-sidebar-nav-icon {
            color: #00d4f5 !important;
        }

        .c-sidebar .c-sidebar-nav-link.c-active .c-sidebar-nav-icon {
            color: #00d4f5 !important;
        }

        /* Iconos submenú */
        .c-sidebar .c-sidebar-nav-dropdown-items .c-sidebar-nav-icon {
            font-size: 13px !important;
            color: #406a96 !important;
        }

        .c-sidebar .c-sidebar-nav-dropdown-items .c-sidebar-nav-link:hover .c-sidebar-nav-icon {
            color: #00d4f5 !important;
        }

        .c-sidebar .c-sidebar-nav-dropdown-items .c-sidebar-nav-link.c-active .c-sidebar-nav-icon {
            color: #00d4f5 !important;
        }

        /* ── Botón minimizar ──────────────────────────────────────── */
        .c-sidebar-minimizer {
            background: rgba(255, 255, 255, 0.04) !important;
            border-top: 1px solid rgba(255, 255, 255, 0.06) !important;
            transition: background 0.2s !important;
        }

        .c-sidebar-minimizer:hover {
            background: rgba(255, 255, 255, 0.1) !important;
        }

        /* ── Sidebar minimizado: mostrar iconos con color ─────────── */
        .c-sidebar-minimized .c-sidebar-nav-link .c-sidebar-nav-icon,
        .c-sidebar-minimized .c-sidebar-nav-dropdown-toggle .c-sidebar-nav-icon {
            color: #4b5563 !important;
        }

        .c-sidebar-minimized .c-sidebar-nav-link:hover .c-sidebar-nav-icon {
            color: #60a5fa !important;
        }
        .license-notification {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 99999 !important;
            animation: slideUp 0.5s ease-out;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .license-notification.warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .license-notification.danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            animation: pulse 2s infinite;
        }

        .license-notification .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
        }

        .license-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .license-icon {
            font-size: 24px;
        }

        .license-text {
            font-size: 14px;
            font-weight: 500;
        }

        .license-days {
            font-size: 20px;
            font-weight: bold;
            padding: 5px 15px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            margin-left: 10px;
        }

        .license-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .license-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .license-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .license-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer !important;
            transition: all 0.3s;
            font-size: 18px;
            line-height: 1;
            pointer-events: auto !important;
            user-select: none;
            -webkit-user-select: none;
        }

        .license-close:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
        }

        .license-close:active {
            transform: scale(0.95);
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(100%);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.85;
            }
        }

        .c-wrapper {
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh;
        }

        .c-body {
            flex: 1 1 auto;
        }

        <?php if($showNotification): ?>
        .c-body {
            padding-bottom: 70px !important;
        }

        .c-wrapper {
            padding-bottom: 70px !important;
        }

        .c-main {
            margin-bottom: 70px !important;
        }
        <?php endif; ?>
    </style>

</head>

<body class="c-app">
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed">
            <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="c-subheader justify-content-between px-3">
                <?php echo $__env->yieldContent('breadcrumb'); ?>
            </div>
        </header>

        <div class="c-body">
            <main class="c-main">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
            <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showNotification): ?>

        <div class="license-notification <?php echo e($daysRemaining <= 7 ? 'danger' : ($daysRemaining <= 15 ? 'warning' : '')); ?>"
            id="licenseNotification">
            <div class="container-fluid">
                <div class="license-content">
                    <span class="license-icon">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($daysRemaining == 0): ?>
                            🔴
                        <?php elseif($daysRemaining <= 3): ?>
                            ⚠️
                        <?php elseif($daysRemaining <= 7): ?>
                            ⏰
                        <?php else: ?>
                            ⚡
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                    <div>
                        <div class="license-text">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($daysRemaining == 0): ?>
                                <strong>¡Su licencia expira HOY!</strong> El sistema podría dejar de funcionar.
                            <?php elseif($daysRemaining == 1): ?>
                                <strong>¡Su licencia expira MAÑANA!</strong> Renueve su licencia urgentemente.
                            <?php elseif($daysRemaining <= 7): ?>
                                <strong>¡Atención!</strong> Su licencia está por vencer pronto.
                            <?php else: ?>
                                <strong>Recordatorio:</strong> Su licencia está próxima a vencer.
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="license-text" style="font-size: 12px; opacity: 0.9;">
                            Fecha de vencimiento: <?php echo e($licence->license_expiration_date->format('d/m/Y')); ?>

                        </div>
                    </div>
                    <span class="license-days">
                        <?php echo e($daysRemaining); ?> <?php echo e($daysRemaining == 1 ? 'día' : 'días'); ?>

                    </span>
                </div>
                <div class="license-actions">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?>
                        <a href="<?php echo e(route('settings.licence.index')); ?>" class="license-btn">
                            <i class="fas fa-cog"></i> Renovar
                        </a>
                    <?php endif; ?>
                    <button class="license-close" type="button" onclick="closeLicenseNotification(); return false;"
                        title="Cerrar notificación">
                        ✕
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo $__env->make('includes.main-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        let notificationClosed = false;

        function closeLicenseNotification() {
            if (notificationClosed) return false;

            const notification = document.getElementById('licenseNotification');
            if (!notification) return false;

            notificationClosed = true;
            notification.style.animation = 'slideDown 0.3s ease-out';

            setTimeout(() => {
                notification.remove();
                document.querySelector('.c-body').style.paddingBottom = '0';
            }, 300);

            return false;
        }
    </script>
</body>

</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>