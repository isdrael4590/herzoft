<div class="position-relative" x-data="{
    focusedIndex: -1,
    getItems() {
        return Array.from(document.querySelectorAll('#search-results-list-reproc .search-result-item'));
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
                        document.getElementById('SearchInputREPROC').focus();
                        event.preventDefault();
                    }
                }">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="bi bi-search text-primary"></i>
                        </div>
                    </div>
                    <input
                        id="SearchInputREPROC"
                        wire:model.live.debounce.500ms="query"
                        @keydown.f1.window="resetQuery"
                        @keydown.arrow-down.prevent="moveDown()"
                        @keydown.arrow-up.prevent="moveUp()"
                        @keydown.enter.prevent="selectFocused()"
                        @keydown.escape="$wire.resetQuery()"
                        type="text"
                        class="form-control"
                        placeholder="Escribir Nombre o Código del producto a Reprocesar....">
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

    @if (!empty($query))
        <div wire:click="resetQuery" class="position-fixed w-100 h-100"
            style="left:0;top:0;right:0;bottom:0;z-index:9997;"></div>

        @if ($search_resultREPROCs->isNotEmpty())
            <div class="card position-absolute mt-1" style="z-index:9999;left:0;right:0;border:0;">
                <div class="card-body shadow" style="max-height:380px;overflow-y:auto;">
                    <ul id="search-results-list-reproc" class="list-group list-group-flush">
                        @foreach ($search_resultREPROCs as $result)
                            <li class="list-group-item list-group-item-action search-result-item"
                                :class="focusedIndex === {{ $loop->index }} ? 'active' : ''"
                                @mouseenter="focusedIndex = {{ $loop->index }}"
                                wire:click="resetQuery"
                                wire:click.prevent="selectProduct({{ $result }})"
                                style="cursor:pointer;">
                                <a href="#" :class="focusedIndex === {{ $loop->index }} ? 'text-white' : ''">
                                    {{ $result->product_name }} -> {{ $result->product_code }}
                                </a>
                            </li>
                        @endforeach
                        @if ($search_resultREPROCs->count() >= $how_many)
                            <li class="list-group-item list-group-item-action text-center">
                                <a wire:click.prevent="loadMore" class="btn btn-primary btn-sm" href="#">
                                    Cargar Más <i class="bi bi-arrow-down-circle"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        @else
            <div class="card position-absolute mt-1 border-0" style="z-index:9998;left:0;right:0;">
                <div class="card-body shadow">
                    <div class="alert alert-warning mb-0">
                        Producto no encontrado...
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
