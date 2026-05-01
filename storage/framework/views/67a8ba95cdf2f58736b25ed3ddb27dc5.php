<div>
    <div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('message')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="alert-body">
                    <span><?php echo e(session('message')); ?></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                        <th class="align-middle">Descripción del Instrumental</th>
                        <th class="align-middle">Código del Instrumental</th>
                        <th class="align-middle text-center">Cantidad </th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center">Expiración</th>
                        <th class="align-middle text-center">Otra Info.</th>
                        <th class="align-middle text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr wire:key="cart-<?php echo e($cart_item->rowId); ?>">

                                <td class="align-middle">
                                    <?php echo e($cart_item->name); ?> <br>

                                </td>
                                <td class="align-middle">
                                    <?php echo e($cart_item->options->code); ?>

                                </td>
                         
                                <td class="align-middle text-center">
                                    <?php echo $__env->make('livewire.includes.product-carttoEXP-quantity', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                </td>
                                <td class="align-middle text-center">

                                    <?php echo e($cart_item->options->product_package_wrap); ?> 

                                </td>
                                <td class="align-middle text-center">
                                    <?php echo \Carbon\Carbon::parse($cart_item->options->product_expiration)->format('d M, Y'); ?>

                                </td>

                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_patient); ?> / [
                                        <?php echo e($cart_item->options->product_outside_company); ?>

                                    ]
                                </td>

                       
                                <td class="align-middle text-center">
                                    <a href="#" wire:click.prevent="removeItem('<?php echo e($cart_item->rowId); ?>')">
                                        <i class="bi bi-x-circle font-2xl text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-danger">Por favor buscar y seleccionar el paquete!</span>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-md-end">
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-striped">

                    <tr>
                        <th>Total Paquetes del Despachados</th>
                        <?php
                            $total_package = Cart::instance($cart_instance)->subtotal();
                        ?>
                        <th>
                            <?php echo e($total_package); ?>

                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <input type="hidden" name="total_amount" value="<?php echo e($total_package); ?>">

    <script>
        window.addEventListener('focusQuantity', (event) => {
            setTimeout(() => {
                const input = document.getElementById('qty-' + event.detail.productId);
                if (input) {
                    input.focus();
                    input.select();
                }
            }, 150);
        });
    </script>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/product-carttoEXP.blade.php ENDPATH**/ ?>