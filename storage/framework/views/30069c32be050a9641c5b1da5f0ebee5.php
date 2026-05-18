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
                        <th class="align-middle">Descripción/Código</th>
                        <th class="align-middle text-center">Cantidad</th>
                        <th class="align-middle text-center">Zona proveniente</th>
                        <th class="align-middle text-center">Disponibilidad</th>
                        <th class="align-middle text-center">Paciente</th>
                        <th class="align-middle text-center">Casa Comercial</th>
                        <th class="align-middle text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:key="cart-<?php echo e($cart_item->rowId); ?>">
                            <td class="align-middle text-center">
                                <?php echo e($cart_item->name); ?> <br>
                                <span class="badge badge-info">
                                    <?php echo e($cart_item->options->code); ?>

                                </span>
                            </td>
                            <td class="align-middle text-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($readonly_qty ?? false): ?>
                                    <span class="badge badge-secondary" style="font-size:.9rem;padding:6px 12px;">
                                        <?php echo e($cart_item->qty); ?>

                                    </span>
                                <?php else: ?>
                                    <?php echo $__env->make('livewire.includes.product-cart-quantity', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="align-middle text-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart_item->options->product_coming_zone == 'Zona Esteril'): ?>
                                    <span class="badge badge-warning">
                                        <?php echo e($cart_item->options->product_coming_zone); ?>

                                    </span>
                                <?php elseif($cart_item->options->product_coming_zone == 'Recepcion'): ?>
                                    <span class="badge badge-primary">
                                        <?php echo e($cart_item->options->product_coming_zone); ?>

                                    </span>
                                <?php elseif($cart_item->options->product_coming_zone == 'Lavado'): ?>
                                    <span class="badge badge-info">
                                        <?php echo e($cart_item->options->product_coming_zone); ?>

                                    </span>
                                <?php elseif($cart_item->options->product_coming_zone == 'Preparación'): ?>
                                    <span class="badge badge-success">
                                        <?php echo e($cart_item->options->product_coming_zone); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php echo $__env->make('livewire.includes.product-cart-modaltoPRE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td class="align-middle text-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart_item->options->product_state_preparation == 'Reprocesar'): ?>
                                    <span class="badge badge-info">
                                        <?php echo e($cart_item->options->product_state_preparation); ?>

                                    </span>
                                <?php elseif($cart_item->options->product_state_preparation == 'Disponible'): ?>
                                    <span class="badge badge-success">
                                        <?php echo e($cart_item->options->product_state_preparation); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="align-middle text-center">
                                <?php echo e($cart_item->options->product_patient); ?> <br>
                            </td>
                            <td class="align-middle text-center">
                                <?php echo e($cart_item->options->product_outside_company); ?> <br>
                            </td>
                            <td class="align-middle text-center">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!($readonly_qty ?? false)): ?>
                                    <a href="#" wire:click.prevent="removeItem('<?php echo e($cart_item->rowId); ?>')">
                                        <i class="bi bi-x-circle font-2xl text-danger"></i>
                                    </a>
                                <?php else: ?>
                                    <i class="bi bi-lock text-secondary"></i>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <span class="text-danger">
                                    Por favor buscar y seleccionar el paquete!
                                </span>
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
                        <th>Total Paquetes Ingresados</th>
                        <?php
                            $total_package = Cart::instance($cart_instance)->count();
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
<?php /**PATH /var/www/html/resources/views/livewire/product-carttoPRE.blade.php ENDPATH**/ ?>