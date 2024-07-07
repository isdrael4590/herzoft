<div class="d-inline-block">
    <!-- Button trigger Discount Modal -->
    <span wire:click="$dispatch('OutputStateStockRefresh', { product_id: {{ $cart_item->id }}, row_id: '{{ $cart_item->rowId }}' })" role="button" class="badge badge-warning pointer-event" data-toggle="modal" data-target="#OutputStateStock{{ $cart_item->id }}">
        <i class="bi bi-pencil-square text-white"></i>
    </span>
    <!-- Discount Modal -->
    <div wire:ignore.self class="modal fade" id="OutputStateStock{{ $cart_item->id }}" tabindex="-1" role="dialog" aria-labelledby="OutputStateStockLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="OutputStateStockLabel">
                        {{ $cart_item->name }}
                        <br>
                        <span class="badge badge-success">
                        {{ $cart_item->options->code }}
                    </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('message_OutputStateStock' . $cart_item->id))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <span>{{ session('message_OutputStateStock' . $cart_item->id) }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Tipo de envoltura <span class="text-danger">*</span></label>
                        <select wire:model.live="package_wrap.{{ $cart_item->id }}" class="form-control" required>
                            <option selected value="Contenedor"> Contenedor Rígido</option>
                            <option value="Papel Mixto"> Papel Mixto </option>
                            <option value="Tela No Tejida"> Tela No Tejida </option>
                            <option value="Lamina SMS"> Lámina SMS</option>
                            <option value="Otro"> Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado Stock <span class="text-danger">*</span></label>
                        <select wire:model.live="status_stock.{{ $cart_item->id }}" class="form-control" required>
                            <option selected ="Disponible"> Disponible</option>
                            <option value="No Disponible"> No Disponible</option>
                        </select>
                    </div>
                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button wire:click="setProductoptions('{{ $cart_item->rowId }}', {{ $cart_item->id }})" type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
