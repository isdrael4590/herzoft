<div class="position-relative" x-data="{
    focusedIndex: -1,
    getItems() {
        return Array.from(document.querySelectorAll('#search-washer-results-list .search-washer-result-item'));
    },
    moveDown() {
        const items = this.getItems();
        if (!items.length) return;
        this.focusedIndex = Math.min(this.focusedIndex + 1, items.length - 1);
        items[this.focusedIndex]?.scrollIntoView({ block: 'nearest' });
    },
    moveUp() {
        if (this.focusedIndex > 0) {
            this.focusedIndex--;
            this.getItems()[this.focusedIndex]?.scrollIntoView({ block: 'nearest' });
        } else {
            this.focusedIndex = -1;
        }
    },
    selectFocused() {
        if (this.focusedIndex >= 0) {
            this.getItems()[this.focusedIndex]?.click();
        }
    }
}" @search-washer-updated.window="focusedIndex = -1">

    <div class="card mb-0 border-0 shadow-sm">
        <div class="card-body">
            <div class="form-group mb-0">
                <div class="input-group" x-data="{
                    resetQuery(event) {
                        document.getElementById('SearchWasherInput').focus();
                        event.preventDefault();
                    }
                }">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="bi bi-search text-primary"></i>
                        </div>
                    </div>
                    <input
                        id="SearchWasherInput"
                        wire:model.live.debounce.500ms="query"
                        @keydown.f1.window="resetQuery"
                        @keydown.arrow-down.prevent="moveDown()"
                        @keydown.arrow-up.prevent="moveUp()"
                        @keydown.enter.prevent="selectFocused()"
                        @keydown.escape="$wire.resetQuery()"
                        type="text"
                        class="form-control"
                        placeholder="Escribir Nombre o Código del producto para Lavado....">
                </div>
            </div>
        </div>
    </div>

    <div wire:loading class="card position-absolute mt-1 border-0" style="z-index:9998;left:0;right:0;">
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
            style="left:0;top:0;right:0;bottom:0;z-index:9997;"></div>

        <!--[if BLOCK]><![endif]--><?php if($search_results->isNotEmpty()): ?>
            <div class="card position-absolute mt-1" style="z-index:9999;left:0;right:0;border:0;">
                <div class="card-body shadow" style="max-height:380px;overflow-y:auto;">
                    <ul id="search-washer-results-list" class="list-group list-group-flush">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $search_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action search-washer-result-item"
                                :class="focusedIndex === <?php echo e($loop->index); ?> ? 'active' : ''"
                                @mouseenter="focusedIndex = <?php echo e($loop->index); ?>"
                                wire:click="resetQuery"
                                wire:click.prevent="selectProduct(<?php echo e($result); ?>)"
                                style="cursor:pointer;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>
                                        <?php echo e($result->product_name); ?>

                                        <small class="ml-1" :class="focusedIndex === <?php echo e($loop->index); ?> ? 'text-white-50' : 'text-muted'">
                                            <?php echo e($result->product_code); ?>

                                        </small>
                                    </span>
                                    <span class="badge ml-2 <?php echo e($result->product_quantity > 0 ? 'badge-success' : 'badge-warning'); ?>"
                                          style="font-size:.75rem;white-space:nowrap;">
                                        Stock: <?php echo e($result->product_quantity); ?>

                                    </span>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!--[if BLOCK]><![endif]--><?php if($search_results->count() >= $how_many): ?>
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
            <div class="card position-absolute mt-1 border-0" style="z-index:9998;left:0;right:0;">
                <div class="card-body shadow">
                    <div class="alert alert-warning mb-0">
                        Producto no encontrado...
                    </div>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /var/www/html/resources/views/livewire/search-product-washer.blade.php ENDPATH**/ ?>