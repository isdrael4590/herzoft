

<?php if($data->product_quantity == 0): ?>
    <span class="badge badge-dark">
        <?php echo e($data->product_coming_zone); ?>

    </span>
<?php elseif($data->product_quantity >= 1 && $data->product_quantity <= 2): ?>
    <span class="badge badge-warning">
        <?php echo e($data->product_coming_zone); ?> </span>
<?php elseif($data->product_quantity >= 3 && $data->product_quantity <= 4): ?>
    <span class="badge badge-primary">
        <?php echo e($data->product_coming_zone); ?> </span>
<?php elseif($data->product_quantity >= 5): ?>
    <span class="badge badge-success">
        <?php echo e($data->product_coming_zone); ?> </span>
<?php endif; ?><?php /**PATH /var/www/html/Modules/Preparation/Resources/views/partials/product_coming_zone.blade.php ENDPATH**/ ?>