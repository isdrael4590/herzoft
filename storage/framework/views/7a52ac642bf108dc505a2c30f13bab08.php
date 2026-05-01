
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
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_admin')): ?>
                            <th class="align-middle">Id</th>
                        <?php endif; ?>
                        <th class="align-middle text-center">Descripción del Instrumental</th>
                        <th class="align-middle text-center">Código del Instrumental</th>
                        <th class="align-middle text-center">Cantidad Procesado</th>
                        <th class="align-middle text-center">Cantidad Validado</th>
                        <th class="align-middle text-center">Tipo de Envoltura </th>
                        <th class="align-middle text-center">Validación Embalaje e Indicador </th>
                        <th class="align-middle text-center"> Ind. 4 ó 5</th>
                        <th class="align-middle text-center"> Venc. </th>
                        <th class="align-middle text-center"> Otra Info. </th>

                    </tr>
                </thead>
                <tbody>
                    <!--[if BLOCK]><![endif]--><?php if($cart_items->isNotEmpty()): ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cart_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_admin')): ?>
                                    <td class="align-middle text-center">
                                        <?php echo e($cart_item->id); ?>

                                    </td>
                                <?php endif; ?>
                                <td class="align-middle">
                                    <?php echo e($cart_item->name); ?> <br>
                                </td>
                                <td class="align-middle">
                                    <?php echo e($cart_item->options->code); ?>

                                </td>
                                <td class="align-middle text-center text-center">
                                    <?php echo e($cart_item->options->stock); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <?php echo $__env->make('livewire.includes.product-carttoDES-quantity', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>
                                <td class="align-middle text-center text-center">
                                    <span>
                                        <?php echo e($cart_item->options->product_package_wrap); ?>

                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_eval_package); ?> <?php echo $__env->make('livewire.includes.product-cart-modaltoDES', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </td>

                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_eval_indicator); ?>

                                </td>
                                <td class="align-middle text-center">
                                    <!--[if BLOCK]><![endif]--><?php if($cart_item->options->product_expiration >= 15): ?>
                                    <!--[if BLOCK]><![endif]--><?php if($cart_item->options->product_expiration == 180): ?>
                                        6 Meses <br>
                                    <?php elseif($cart_item->options->product_expiration == 270): ?>
                                        9 Meses <br>
                                    <?php elseif($cart_item->options->product_expiration == 365): ?>
                                        12 Meses <br>
                                    <?php elseif($cart_item->options->product_expiration == 545): ?>
                                        18 Meses <br>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <?php else: ?>
                                    <?php echo e($cart_item->options->product_expiration); ?> Días <br>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </td>
                                <td class="align-middle text-center">
                                    <?php echo e($cart_item->options->product_patient); ?> // [
                                    <?php echo e($cart_item->options->product_outside_company); ?>] 

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
    <div class="row justify-content-md-end">
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-striped">
                   
                    <tr>
                        <th>Total Paquetes Estériles</th>
                        <?php
                            $total_package = Cart::instance($cart_instance)->subtotal()
                        ?>
                        <th>
                             <?php echo e(($total_package)); ?>

                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <input type="hidden" name="total_amount" value="<?php echo e($total_package); ?>">

</div>
<?php /**PATH /var/www/html/resources/views/livewire/product-carttoDES.blade.php ENDPATH**/ ?>