<div class="position-relative">
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
                        @keydown.f1.window="resetQuery" 
                        wire:model.live.debounce.500ms="query" 
                        type="text"
                        class="form-control" 
                        placeholder="Buscar por código, nombre, tipo, marca o estado del instrumental..."
                        id="SearchInputInstrumental"
                    >
                </div>
            </div>
        </div>
    </div>

    <div wire:loading class="card position-absolute mt-1 border-0" style="z-index: 9998; left: 0; right: 0;">
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
            style="left: 0; top: 0; right: 0; bottom: 0; z-index: 9997;"></div>
        
        @if ($search_results->isNotEmpty())
            <div class="card position-absolute mt-1" style="z-index: 9999; left: 0; right: 0; border: 0;">
                <div class="card-body shadow">
                    <ul class="list-group list-group-flush">
                        @foreach ($search_results as $result)
                            <li class="list-group-item list-group-item-action" 
                                wire:click="resetQuery"
                                wire:click.prevent="selectInstrumental({{ $result }})">
                                <a href="#">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $result->codigo_unico_ud }}</strong> - {{ $result->nombre_generico }}
                                            <br>
                                            <small class="text-muted">
                                                <i class="bi bi-tag"></i> {{ $result->tipo_familia ?? 'N/A' }} | 
                                                <i class="bi bi-building"></i> {{ $result->marca_fabricante ?? 'N/A' }}
                                            </small>
                                        </div>
                                        <span class="badge badge-{{ $result->estado_actual === 'DISPONIBLE' ? 'success' : ($result->estado_actual === 'EN_USO' ? 'warning' : ($result->estado_actual === 'MANTENIMIENTO' ? 'info' : 'secondary')) }}">
                                            {{ str_replace('_', ' ', $result->estado_actual) }}
                                        </span>
                                    </div>
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
            <div class="card position-absolute mt-1 border-0" style="z-index: 9998; left: 0; right: 0;">
                <div class="card-body shadow">
                    <div class="alert alert-warning mb-0">
                        <i class="bi bi-inbox"></i> No se encontraron instrumentales
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>

<script>
    document.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowUp') {
            @this.call('moveUp');
        } else if (event.key === 'ArrowDown') {
            @this.call('moveDown');
        }
    });
</script>