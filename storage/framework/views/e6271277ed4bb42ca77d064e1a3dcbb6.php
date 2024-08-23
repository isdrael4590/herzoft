<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show <?php echo e(request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : ''); ?>" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <a href="<?php echo e(route('home')); ?>">
            <img class="c-sidebar-brand-full" src="<?php echo e(asset('images/LOGOHERZ.jpg')); ?>" alt="Site Logo" width="110">
            <img class="c-sidebar-brand-minimized" src="<?php echo e(asset('images/LOGOHERZ.jpg')); ?>" alt="Site Logo" width="40">
        </a>
    </div>
    <ul class="c-sidebar-nav">
        <?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 692px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 369px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
<?php /**PATH /var/www/html/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>