<?php $__env->startSection('code', '419 👾'); ?>

<?php $__env->startSection('title', __('Page Expired')); ?>

<?php $__env->startSection('image'); ?>
    <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);" class="absolute pin bg-no-repeat md:bg-left lg:bg-center bg-cover"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('message', __('Maybe, the CSRF token is missing.')); ?>

<?php echo $__env->make('errors.illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/errors/419.blade.php ENDPATH**/ ?>