<?php $sidebarLogo = settings()->getFirstMediaUrl('settings'); ?>

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show <?php echo e(request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : ''); ?>" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <a href="<?php echo e(route('home')); ?>" style="display:flex;align-items:center;justify-content:center;width:100%;">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebarLogo): ?>
                <img class="c-sidebar-brand-full" src="<?php echo e($sidebarLogo); ?>" alt="Logo"
                     width="110" style="object-fit:contain;max-height:48px;"
                     onerror="this.style.display='none';document.getElementById('brand-text-full').style.display='flex';">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div id="brand-text-full" class="c-sidebar-brand-full"
                 style="<?php echo e($sidebarLogo ? 'display:none;' : 'display:flex;'); ?> align-items:center;gap:10px;">
                <div style="width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,0.15);border:1.5px solid rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-box-seam" style="color:#fff;font-size:1.1rem;"></i>
                </div>
                <span style="color:#fff;font-weight:700;font-size:1rem;letter-spacing:0.5px;white-space:nowrap;">
                    <?php echo e(config('app.name')); ?>

                </span>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebarLogo): ?>
                <img class="c-sidebar-brand-minimized" src="<?php echo e($sidebarLogo); ?>" alt="Logo"
                     width="36" style="object-fit:contain;max-height:36px;border-radius:6px;"
                     onerror="this.style.display='none';document.getElementById('brand-icon-min').style.display='flex';">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div id="brand-icon-min" class="c-sidebar-brand-minimized"
                 style="<?php echo e($sidebarLogo ? 'display:none;' : 'display:flex;'); ?> width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,0.15);border:1.5px solid rgba(255,255,255,0.25);align-items:center;justify-content:center;">
                <i class="bi bi-box-seam" style="color:#fff;font-size:1.1rem;"></i>
            </div>

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