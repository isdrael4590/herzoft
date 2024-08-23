<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
    data-class="c-sidebar-show">
    <i class="bi bi-list" style="font-size: 2rem;"></i>
</button>

<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
    data-class="c-sidebar-lg-show" responsive="true">
    <i class="bi bi-list" style="font-size: 2rem;"></i>
</button>

<ul class="c-header-nav ml-auto">
   
</ul>
<ul class="c-header-nav ml-auto mr-4">


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show_notifications')): ?>
        <li class="c-header-nav-item dropdown d-md-down-none mr-2">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="bi bi-bell" style="font-size: 20px;"></i>
                <span class="badge badge-pill badge-danger">

                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                
            </div>
        </li>
    <?php endif; ?>

    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            <div class="c-avatar mr-2">
                <img class="c-avatar rounded-circle" src="<?php echo e(auth()->user()->getFirstMediaUrl('avatars')); ?>"
                    alt="Profile Image">
            </div>
            <div class="d-flex flex-column">
                <span class="font-weight-bold"><?php echo e(auth()->user()->name); ?></span>
                <span class="font-italic">En Línea <i class="bi bi-circle-fill text-success"
                        style="font-size: 11px;"></i></span>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>Cuenta</strong></div>
            <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">
                <i class="mfe-2  bi bi-person" style="font-size: 1.2rem;"></i> Perfil
            </a>
            <a class="dropdown-item" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="mfe-2  bi bi-box-arrow-left" style="font-size: 1.2rem;"></i> Salir
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </li>
</ul>
<?php /**PATH /var/www/html/resources/views/layouts/header.blade.php ENDPATH**/ ?>