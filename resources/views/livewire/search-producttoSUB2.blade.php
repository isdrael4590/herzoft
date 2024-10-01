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
                    <input wire:keydown.escape="resetInput" wire:model.live="description_input" name="description_input" type="text"
                        placeholder="Escribir Nombre del Instrumental...." class="form-control">

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
    @if (!empty($description_input))
        <div wire:click="resetInput" class="position-fixed w-100 h-100"
            style="left: 0; top: 0; right: 0; bottom: 0;z-index: 1;"></div>

            <div class="card position-absolute mt-1" style="z-index: 2;left: 0;right: 0;border: 0;">
                <div class="card-body shadow">
                    <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action">
                                <a wire:click="resetInput" wire:click.prevent="selectSubProduct({{ $results_input }})"
                                    href="#">
                                   <h1> {{ $results_input }}</h1>
                                </a>
                            </li>
                
                    </ul>
                </div>
            </div>

    @endif

</div>
