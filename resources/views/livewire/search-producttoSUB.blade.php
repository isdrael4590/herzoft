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

  

    @if (!empty($query))
        <div wire:click="resetQuery" class="position-fixed w-100 h-100"
            style="left: 0; top: 0; right: 0; bottom: 0;z-index: 1;"></div>

        <div class="card position-absolute mt-1" style="z-index: 2;left: 0;right: 0;border: 0;">
            <div class="card-body shadow">
                <ul class="list-group list-group-flush">
                    @foreach ($search_results as $result)
                        <li class="list-group-item list-group-item-action">
                            <a wire:click="resetQuery" wire:click.prevent="selectProduct({{ $result }})"
                                href="#">
                                {{ $result->product_name }} | {{ $result->product_code }}
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

    @endif
</div>
