
<?php if($data->product_quantity == 0): ?>
    <span class="badge badge-dark">
        <?php echo Carbon\Carbon::parse($data->product_expiration)->format('d M, Y'); ?>

    </span>
<?php elseif($data->product_quantity >= 1 && $data->product_quantity <= 2): ?>
    <span class="badge badge-warning">
        <?php echo Carbon\Carbon::parse($data->product_expiration)->format('d M, Y'); ?>

    </span>
<?php elseif($data->product_quantity >= 3 && $data->product_quantity <= 4): ?>
    <span class="badge badge-primary">
        <?php echo Carbon\Carbon::parse($data->product_expiration)->format('d M, Y'); ?>

    </span>
<?php elseif($data->product_quantity >= 5): ?>
    <span class="badge badge-success">
        <?php echo Carbon\Carbon::parse($data->product_expiration)->format('d M, Y'); ?>

    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/Modules/Stock/Resources/views/partials/dates.blade.php ENDPATH**/ ?>