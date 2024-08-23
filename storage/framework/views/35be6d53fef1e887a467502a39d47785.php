<!-- Dropezone CSS -->
<link rel="stylesheet" href="<?php echo e(asset('css/dropzone.css')); ?>">
<!-- CoreUI CSS -->
<?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
<link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.5/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/sl-1.7.0/datatables.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


<?php echo $__env->yieldContent('third_party_stylesheets'); ?>

<?php echo $__env->yieldPushContent('page_css'); ?>

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


<style>
    div.dataTables_wrapper div.dataTables_length select {
        width: 65px;
        display: inline-block;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #D8DBE0;
        border-radius: 4px;
    }
    .select2-container--default .select2-selection--multiple {
        background-color: #fff;
        border: 1px solid #D8DBE0;
        border-radius: 4px;
    }
    .select2-container .select2-selection--multiple {
        height: 35px;
    }
    .select2-container .select2-selection--single {
        height: 35px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 33px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        margin-top: 2px;
    }
</style>
<?php /**PATH /var/www/html/resources/views/includes/main-css.blade.php ENDPATH**/ ?>