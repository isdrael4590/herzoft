<?php $__env->startSection('code', '403 🤐'); ?>

<?php $__env->startSection('title', __('Unauthorized')); ?>

<?php $__env->startSection('image'); ?>
    <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);" class="absolute pin bg-no-repeat md:bg-left lg:bg-center bg-cover"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('message', __('Lo siento, usted no tiene permiso para visitar esta página.')); ?>

<?php echo $__env->make('errors.illustrated-layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/errors/403.blade.php ENDPATH**/ ?>