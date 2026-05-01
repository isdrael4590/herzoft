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

    <?php
        $dirtBadge = [
            'NO CRITICO' => 'badge-info',
            'SEMICRITICO' => 'badge-warning',
            'CRITICO' => 'badge-danger',
            'REPROCESADO' => 'badge-secondary',
        ];
    ?>

    <div class="table-responsive position-relative">
        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center"
            style="top:0;right:0;left:0;bottom:0;background-color:rgba(255,255,255,0.5);z-index:99;">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?>
                        <th class="align-middle">ID_prelaDeta / ID_Product</th>
                    <?php endif; ?>
                    <th class="align-middle">Descripción / Código</th>
                    <th class="align-middle text-center">Cantidad</th>
                    <th class="align-middle text-center">Nivel de Infección</th>
                    <th class="align-middle text-center">Estado del instrumental</th>
                    <th class="align-middle text-center">Paciente</th>
                    <th class="align-middle text-center">Casa Comercial</th>
                    <th class="align-middle text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr wire:key="cart-<?php echo e($cart_item->rowId); ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_admin')): ?>
                            <td class="align-middle">
                               <?php echo e($cart_item->id); ?> / 
                               <?php echo e($cart_item->options->product_id); ?>

                            </td>
                        <?php endif; ?>
                        <td class="align-middle">
                            <?php echo e($cart_item->name); ?><br>
                            <span class="badge badge-info"><?php echo e($cart_item->options->code); ?></span>
                        </td>
                   
                        <td class="align-middle text-center">
                            <?php echo $__env->make('livewire.includes.product-cart-wash-quantity', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                        <td class="align-middle text-center">
                            <?php $dirt = $cart_item->options->product_type_dirt; ?>
                            <span class="badge <?php echo e($dirtBadge[$dirt] ?? 'badge-secondary'); ?>">
                                <?php echo e($dirt); ?>

                            </span>
                            <?php echo $__env->make('livewire.includes.product-cart-modaltoWash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                        <td class="align-middle text-center">
                            <span class="badge badge-secondary">
                                <?php echo e($cart_item->options->product_state_rumed); ?>

                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="badge badge-secondary">
                                <?php echo e($cart_item->options->product_patient); ?>

                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="badge badge-secondary">
                                <?php echo e($cart_item->options->product_outside_company); ?>

                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <a href="#" wire:click.prevent="removeItem('<?php echo e($cart_item->rowId); ?>')">
                                <i class="bi bi-x-circle font-2xl text-danger"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            <span class="text-danger">Por favor buscar y seleccionar el paquete!</span>
                        </td>
                    </tr>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </tbody>
        </table>
    </div>

    <div class="row justify-content-md-end">
        <div class="col-md-4">
            <div class="table-responsive">
                <?php $total_package = $cart_items->sum('qty') ?>
                <table class="table table-striped">
                    <tr>
                        <th>Total Paquetes a lavar</th>
                        <th><?php echo e($total_package); ?></th>
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

        window.addEventListener('closeProductModal', (event) => {
            const modalEl = document.getElementById('inputDyrtState' + event.detail.productId);
            if (modalEl) {
                $(modalEl).removeClass('show').hide();
                $(modalEl).attr('aria-hidden', 'true').removeAttr('aria-modal').css('display', '');
            }
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css('padding-right', '');
        });
    </script>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/product-cart-washer.blade.php ENDPATH**/ ?>