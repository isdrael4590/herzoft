<div>
    <div>
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    <span><?php echo e(session('message')); ?></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <div class="table-responsive position-relative">
            <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center"
                style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Cargando...</span>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle">Id</th>
                        <th class="align-middle">productid</th>
                        <th class="align-middle">Paquete / Código</th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center"> Embalaje </th>
                        <th class="align-middle text-center"> Ind. 4 ó 5 </th>
                        <th class="align-middle text-center"> Venc. </th>
                        <th class="align-middle text-center"> Procesamiento. </th>
                        <th class="align-middle text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php if($cart_items->isNotEmpty()): ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->id); ?>

                                </td>
                                <td class="align-middle">
                                    <?php echo e($cart_item->name); ?> <br>
                                    <span class="badge badge-success">
                                        <?php echo e($cart_item->options->code); ?>

                                    </span>

                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_id); ?>

                                </td>
                                <td class="align-middle text-center">

                                    <?php echo e($cart_item->options->product_package_wrap); ?> <?php echo $__env->make('livewire.includes.product-cart-modaltoQR', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_eval_package); ?>

                                </td>

                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_eval_indicator); ?>

                                </td>

                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_expiration); ?> <span> meses</span>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_type_process); ?>

                                </td>

                                <td class="align-middle text-center">
                                    <a href="#" wire:click.prevent="removeItem('<?php echo e($cart_item->rowId); ?>')">
                                        <i class="bi bi-x-circle font-2xl text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-danger">
                                    Por favor buscar y seleccionar el paquete !
                                </span>
                            </td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php /**PATH /var/www/html/resources/views/livewire/product-carttoQR.blade.php ENDPATH**/ ?>