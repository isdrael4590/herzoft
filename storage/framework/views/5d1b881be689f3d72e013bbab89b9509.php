<?php
    $user = auth()->user();
    $avatarUrl = $user->getFirstMediaUrl('avatars');
    $initials = collect(explode(' ', $user->name))->map(fn($w) => strtoupper($w[0]))->take(2)->join('');
?>

<style>
    /* ── Header bar ──────────────────────────────────────────── */
    .c-header {
        border-bottom: 1px solid #e9ecef !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06) !important;
    }

    /* Botón toggler sidebar */
    .c-header-toggler {
        color: #5a6878 !important;
        transition: color 0.2s !important;
    }
    .c-header-toggler:hover { color: #1d4ed8 !important; }

    /* ── Campana notificaciones ──────────────────────────────── */
    .header-bell-btn {
        position: relative;
        background: none;
        border: none;
        padding: 6px 10px;
        border-radius: 8px;
        color: #5a6878;
        font-size: 1.2rem;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        line-height: 1;
        display: flex;
        align-items: center;
    }
    .header-bell-btn:hover { background: #f1f5f9; color: #1d4ed8; }
    .header-bell-badge {
        position: absolute;
        top: 4px; right: 6px;
        width: 8px; height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    /* ── Avatar ──────────────────────────────────────────────── */
    .header-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e2e8f0;
    }
    .header-avatar-initials {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        color: #fff;
        font-size: 0.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid #e2e8f0;
        letter-spacing: 0.5px;
    }

    /* ── User trigger ────────────────────────────────────────── */
    .header-user-trigger {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 12px;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none !important;
        color: inherit !important;
    }
    .header-user-trigger:hover { background: #f1f5f9; }
    .header-user-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        line-height: 1.2;
    }
    .header-user-status {
        font-size: 0.73rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .status-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #22c55e;
        display: inline-block;
        box-shadow: 0 0 0 2px rgba(34,197,94,0.2);
    }
    .header-chevron {
        color: #94a3b8;
        font-size: 0.75rem;
        margin-left: 2px;
    }

    /* ── Dropdown menú ───────────────────────────────────────── */
    .header-dropdown-menu {
        min-width: 230px;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        padding: 0;
        overflow: hidden;
        margin-top: 8px !important;
    }
    .header-dropdown-header {
        padding: 14px 16px;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .header-dropdown-header .user-full-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
    }
    .header-dropdown-header .user-email {
        font-size: 0.75rem;
        color: #94a3b8;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
    .header-dropdown-menu .dropdown-item {
        padding: 10px 16px;
        font-size: 0.875rem;
        color: #374151;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.15s;
        border-radius: 0;
    }
    .header-dropdown-menu .dropdown-item:hover {
        background: #f1f5f9;
        color: #1d4ed8;
    }
    .header-dropdown-menu .dropdown-item i {
        font-size: 1rem;
        width: 18px;
        text-align: center;
        color: #94a3b8;
        flex-shrink: 0;
    }
    .header-dropdown-menu .dropdown-item:hover i { color: #1d4ed8; }
    .header-dropdown-menu .dropdown-divider { margin: 0; border-color: #f1f5f9; }
    .dropdown-item-logout { color: #dc2626 !important; }
    .dropdown-item-logout i { color: #dc2626 !important; }
    .dropdown-item-logout:hover { background: #fef2f2 !important; }
</style>

<!-- Toggle sidebar mobile -->
<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button"
    data-target="#sidebar" data-class="c-sidebar-show">
    <i class="bi bi-list" style="font-size:1.6rem;"></i>
</button>

<!-- Toggle sidebar desktop -->
<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button"
    data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
    <i class="bi bi-list" style="font-size:1.6rem;"></i>
</button>

<ul class="c-header-nav ml-auto mr-2 align-items-center">

    <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_notifications')): ?>
    <li class="c-header-nav-item dropdown d-md-down-none mr-1">
        <button class="header-bell-btn c-header-nav-link" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-bell"></i>
            
        </button>
        <div class="dropdown-menu dropdown-menu-right header-dropdown-menu pt-0">
            <div class="px-3 py-2 border-bottom" style="background:#f8fafc;">
                <strong style="font-size:.8rem;color:#374151;">Notificaciones</strong>
            </div>
            <a class="dropdown-item" href="#">
                <i class="bi bi-app-indicator text-muted"></i>
                Sin notificaciones nuevas
            </a>
        </div>
    </li>
    <?php endif; ?>

    
    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link header-user-trigger" data-toggle="dropdown"
            href="#" role="button" aria-haspopup="true" aria-expanded="false">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($avatarUrl): ?>
                <img class="header-avatar" src="<?php echo e($avatarUrl); ?>" alt="<?php echo e($user->name); ?>"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                <div class="header-avatar-initials" style="display:none;"><?php echo e($initials); ?></div>
            <?php else: ?>
                <div class="header-avatar-initials"><?php echo e($initials); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="d-none d-md-block">
                <div class="header-user-name"><?php echo e($user->name); ?></div>
                <div class="header-user-status">
                    <span class="status-dot"></span> En línea
                </div>
            </div>

            <i class="bi bi-chevron-down header-chevron d-none d-md-block"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right header-dropdown-menu">

            
            <div class="header-dropdown-header">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($avatarUrl): ?>
                    <img class="header-avatar" src="<?php echo e($avatarUrl); ?>" alt="<?php echo e($user->name); ?>"
                         onerror="this.outerHTML='<div class=\'header-avatar-initials\'><?php echo e($initials); ?></div>'">
                <?php else: ?>
                    <div class="header-avatar-initials"><?php echo e($initials); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div style="overflow:hidden;">
                    <div class="user-full-name"><?php echo e($user->name); ?></div>
                    <div class="user-email" title="<?php echo e($user->email); ?>"><?php echo e($user->email); ?></div>
                </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_own_profile')): ?>
                <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">
                    <i class="bi bi-person"></i> Mi perfil
                </a>
            <?php endif; ?>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item dropdown-item-logout" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> Cerrar sesión
            </a>

            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </li>

</ul>
<?php /**PATH /var/www/html/resources/views/layouts/header.blade.php ENDPATH**/ ?>