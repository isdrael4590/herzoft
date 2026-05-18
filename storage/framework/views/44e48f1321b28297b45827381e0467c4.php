<div class="position-relative" x-data="{
    focusedIndex: -1,
    getItems() {
        return Array.from(document.querySelectorAll('#search-results-list-instrumental .search-result-item'));
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
}" @search-updated.window="focusedIndex = -1">

    <div class="card mb-0 border-0 shadow-sm">
        <div class="card-body">
            <div class="form-group mb-0">
                <div class="input-group" x-data="{
                    resetQuery(event) {
                        document.getElementById('SearchInputInstrumental').focus();
                        event.preventDefault();
                    }
                }">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="bi bi-search text-primary"></i>
                        </div>
                    </div>
                    <input
                        id="SearchInputInstrumental"
                        wire:model.live.debounce.500ms="query"
                        @keydown.f1.window="resetQuery"
                        @keydown.arrow-down.prevent="moveDown()"
                        @keydown.arrow-up.prevent="moveUp()"
                        @keydown.enter.prevent="selectFocused()"
                        @keydown.escape="$wire.resetQuery()"
                        type="text"
                        class="form-control"
                        placeholder="Buscar por código, nombre, tipo, marca o estado del instrumental...">
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

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($query)): ?>
        <div wire:click="resetQuery" class="position-fixed w-100 h-100"
            style="left:0;top:0;right:0;bottom:0;z-index:9997;"></div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search_results->isNotEmpty()): ?>
            <div class="card position-absolute mt-1" style="z-index:9999;left:0;right:0;border:0;">
                <div class="card-body shadow" style="max-height:380px;overflow-y:auto;">
                    <ul id="search-results-list-instrumental" class="list-group list-group-flush">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $search_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action search-result-item"
                                :class="focusedIndex === <?php echo e($loop->index); ?> ? 'active' : ''"
                                @mouseenter="focusedIndex = <?php echo e($loop->index); ?>"
                                wire:click="resetQuery"
                                wire:click.prevent="selectInstrumental(<?php echo e($result); ?>)"
                                style="cursor:pointer;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong :class="focusedIndex === <?php echo e($loop->index); ?> ? 'text-white' : ''">
                                            <?php echo e($result->codigo_unico_ud); ?>

                                        </strong>
                                        <span :class="focusedIndex === <?php echo e($loop->index); ?> ? 'text-white' : ''">
                                            - <?php echo e($result->nombre_generico); ?>

                                        </span>
                                        <br>
                                        <small :class="focusedIndex === <?php echo e($loop->index); ?> ? 'text-white-50' : 'text-muted'">
                                            <i class="bi bi-tag"></i> <?php echo e($result->tipo_familia ?? 'N/A'); ?> |
                                            <i class="bi bi-building"></i> <?php echo e($result->marca_fabricante ?? 'N/A'); ?>

                                        </small>
                                    </div>
                                    <span class="badge badge-<?php echo e($result->estado_actual === 'DISPONIBLE' ? 'success' : ($result->estado_actual === 'EN_USO' ? 'warning' : ($result->estado_actual === 'MANTENIMIENTO' ? 'info' : 'secondary'))); ?>">
                                        <?php echo e(str_replace('_', ' ', $result->estado_actual)); ?>

                                    </span>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($search_results->count() >= $how_many): ?>
                            <li class="list-group-item list-group-item-action text-center">
                                <a wire:click.prevent="loadMore" class="btn btn-primary btn-sm" href="#">
                                    Cargar Más <i class="bi bi-arrow-down-circle"></i>
                                </a>
                            </li>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="card position-absolute mt-1 border-0" style="z-index:9998;left:0;right:0;">
                <div class="card-body shadow">
                    <div class="alert alert-warning mb-0">
                        <i class="bi bi-inbox"></i> No se encontraron instrumentales
                    </div>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/search-instrumental.blade.php ENDPATH**/ ?>