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

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-middle">Código Instrumental</th>
                        <th class="align-middle">Descripción del Instrumental</th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center">Estado de Stock</th>
                        <th class="align-middle text-center">Fecha Esterilización</th>
                        <th class="align-middle text-center">Expiración</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php if($cart_items->isNotEmpty()): ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle">
                                    <?php echo e($cart_item->options->code); ?>

                                </td>
                                <td class="align-middle">
                                    <?php echo e($cart_item->name); ?>

                                </td>
                                <td class="align-middle text-center text-center">
                                    <span>
                                        <?php echo e($cart_item->options->product_package_wrap); ?>

                                    </span>
                                </td>
                        
                                <td class="align-middle text-center text-center">
                                    <?php echo e($cart_item->options->product_status_stock); ?>  <?php echo $__env->make('livewire.includes.product-cart-modaltoStock', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                                <td class="align-middle text-center text-center">
                                    <?php echo e(\Carbon\Carbon::parse($cart_item->options->product_date_sterilized)->format('d M, Y')); ?>

                                   
                                </td>
                                <td class="align-middle text-center text-center">
                                   
                                   <?php echo \Carbon\Carbon::parse($cart_item->options->product_expiration)->format('d M, Y'); ?>

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
<?php /**PATH /var/www/html/resources/views/livewire/product-carttoStock.blade.php ENDPATH**/ ?>