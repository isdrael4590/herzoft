<div class="position-relative">
    <div class="card mb-0 border-0 shadow-sm">
        <div class="card-body">
            <div class="form-group mb-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="bi bi-search text-primary"></i>
                        </div>
                    </div>
                    <input wire:keydown.escape="resetQuery" wire:model.live.debounce.500ms="query" type="text"
                        class="form-control" placeholder="Escribir Nombre o Código del producto RUMED....">
                </div>
            </div>
        </div>
    </div>

    <div wire:loading class="card position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
        <div class="card-body shadow">
            <div class="d-flex justify-content-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Cargando...</span>
                </div>
            </div>
        </div>
    </div>

    <!--[if BLOCK]><![endif]--><?php if(!empty($query)): ?>
        <div wire:click="resetQuery" class="position-fixed w-100 h-100"
            style="left: 0; top: 0; right: 0; bottom: 0;z-index: 1;"></div>
        <!--[if BLOCK]><![endif]--><?php if($search_resultREPROCs->isNotEmpty()): ?>
            <div class="card position-absolute mt-1" style="z-index: 2;left: 0;right: 0;border: 0;">
                <div class="card-body shadow">
                    <ul class="list-group list-group-flush">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $search_resultREPROCs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!--[if BLOCK]><![endif]--><?php if($result->product_ref_qr == 'Reprocesar'): ?>
                                <li class="list-group-item list-group-item-action">
                                    <a wire:click="resetQuery" wire:click.prevent="selectProduct(<?php echo e($result); ?>)"
                                        href="#">
                                        <?php echo e($result->product_name); ?> | <?php echo e($result->product_code); ?>

                                    </a>
                                </li>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--[if BLOCK]><![endif]--><?php if($search_resultREPROCs->count() >= $how_many): ?>
                            <li class="list-group-item list-group-item-action text-center">
                                <a wire:click.prevent="loadMore" class="btn btn-primary btn-sm" href="#">
                                    Cargar Más <i class="bi bi-arrow-down-circle"></i>
                                </a>
                            </li>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="card position-absolute mt-1 border-0" style="z-index: 1;left: 0;right: 0;">
                <div class="card-body shadow">
                    <div class="alert alert-warning mb-0">
                        Producto no encontrado...
                    </div>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/www/html/resources/views/livewire/search-producttoREPROC.blade.php ENDPATH**/ ?>