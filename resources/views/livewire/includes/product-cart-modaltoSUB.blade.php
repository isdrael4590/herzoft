<div class="d-inline-block">
    <!-- Button trigger Discount Modal -->
    <span
        wire:click="$dispatch('updateSubproductRefresh', { product_id: {{ $cart_item->id }}, row_id: '{{ $cart_item->rowId }}' })"
        role="button" class="badge badge-warning pointer-event" data-toggle="modal"
        data-target="#updateSubproduct{{ $cart_item->id }}">
        <i class="bi bi-pencil-square text-white"></i>
    </span>
    <!-- Discount Modal -->
    <div wire:ignore.self class="modal fade" id="updateSubproduct{{ $cart_item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="updateSubproductLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubproductLabel">
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
                    @if (session()->has('message_updateSubproduct' . $cart_item->id))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <span>{{ session('message_updateSubproduct' . $cart_item->id) }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Nombre del Instrumental <span class="text-danger">*</span></label>
                        <input type="text" wire:model.live="name.{{ $cart_item->id }}" class="form-control" name="name" required
                                            value="{{ $cart_item->name }}">
                        </input>
                        <label>Cantidad del Item <span class="text-danger">*</span></label>
                        <input type="number" wire:model.live="qty.{{ $cart_item->id }}" class="form-control" name="qty" required
                                            value="{{ $cart_item->qty }}">
                        </input>
                    </div>
         
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button wire:click="setSubProductoptions('{{ $cart_item->rowId }}', {{ $cart_item->id }})" type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
