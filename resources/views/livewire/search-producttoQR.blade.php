<div class="position-relative" x-data="{
    focusedIndex: -1,
    getItems() {
        return Array.from(document.querySelectorAll('#search-results-list-qr .search-result-item'));
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
                        document.getElementById('SearchInputQR').focus();
                        event.preventDefault();
                    }
                }">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="bi bi-search text-primary"></i>
                        </div>
                    </div>
                    <input
                        id="SearchInputQR"
                        wire:model.live.debounce.500ms="query"
                        @keydown.f1.window="resetQuery"
                        @keydown.arrow-down.prevent="moveDown()"
                        @keydown.arrow-up.prevent="moveUp()"
                        @keydown.enter.prevent="selectFocused()"
                        @keydown.escape="$wire.resetQuery()"
                        type="text"
                        class="form-control"
                        placeholder="Escribir Nombre o Código del instrumento STEAM (Alta Temperatura)...">
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

        @if ($search_results->isNotEmpty())
            <div class="card position-absolute mt-1" style="z-index:9999;left:0;right:0;border:0;">
                <div class="card-body shadow" style="max-height:380px;overflow-y:auto;">
                    <ul id="search-results-list-qr" class="list-group list-group-flush">
                        @foreach ($search_results as $result)
                            <li class="list-group-item list-group-item-action search-result-item"
                                :class="focusedIndex === {{ $loop->index }} ? 'active' : ''"
                                @mouseenter="focusedIndex = {{ $loop->index }}"
                                wire:click="resetQuery"
                                wire:click.prevent="selectProduct({{ $result }})"
                                style="cursor:pointer;">
                                <a href="#" :class="focusedIndex === {{ $loop->index }} ? 'text-white' : ''">
                                    <i class="bi bi-box-seam"></i>
                                    {{ $result->product_name }}
                                    <span class="badge badge-info ml-1">{{ $result->product_code }}</span>
                                    <span class="badge badge-success ml-1">{{ $result->product_quantity }} Un</span>
                                    @if($result->product_area)
                                        <span class="badge badge-secondary ml-1">{{ $result->product_area }}</span>
                                    @endif
                                    @if($result->product_patient)
                                        <span class="badge badge-warning ml-1"><i class="bi bi-person"></i> {{ $result->product_patient }}</span>
                                    @endif
                                    @if($result->product_outside_company)
                                        <span class="badge badge-primary ml-1"><i class="bi bi-building"></i> {{ $result->product_outside_company }}</span>
                                    @endif
                                    @if($result->product_info)
                                        <span class="badge badge-light text-dark ml-1"><i class="bi bi-info-circle"></i> {{ $result->product_info }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                        @if ($search_results->count() >= $how_many)
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
                        <i class="bi bi-exclamation-triangle"></i> Instrumento no encontrado en stock de preparación STEAM...
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
