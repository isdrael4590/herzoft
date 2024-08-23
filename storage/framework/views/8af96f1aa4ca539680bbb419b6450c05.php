<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title'); ?> || <?php echo e(config('app.name')); ?></title>
    <meta content="herZoft" name="author">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('images/favicon.jpg')); ?>">

    <?php echo $__env->make('includes.main-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        </div>

        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <?php echo $__env->make('includes.main-js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>