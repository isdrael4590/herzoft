<div class="d-inline-block">
    <!-- Button trigger Discount Modal -->
    <span
        wire:click="$dispatch('OutputWrap_packageRefresh', { product_id: {{ $cart_item->id }}, row_id: '{{ $cart_item->rowId }}' })"
        role="button" class="badge badge-warning pointer-event" data-toggle="modal"
        data-target="#OutputWrap_package{{ $cart_item->id }}">
        <i class="bi bi-pencil-square text-white"></i>
    </span>
    <!-- Discount Modal -->
    <div wire:ignore.self class="modal fade" id="OutputWrap_package{{ $cart_item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="OutputWrap_packageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="OutputWrap_packageLabel">
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
                    @if (session()->has('message_OutputWrap_package' . $cart_item->id))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <span>{{ session('message_OutputWrap_package' . $cart_item->id) }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Validación del Embalaje <span class="text-danger">*</span></label>
                        <select wire:model.live="eval_package.{{ $cart_item->id }}" class="form-control" required>
                            <option selected value="OK"> OK</option>
                            <option value="NO"> NO </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contiene Ind. Químico tipo 4 ó 5 <span class="text-danger">*</span></label>
                        <select wire:model.live="eval_indicator.{{ $cart_item->id }}" class="form-control" required>
                            <option selected value="OK"> OK</option>
                            <option value="NO"> NO </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button wire:click="setProductoptions('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
                        type="button" class="btn btn-primary">Guardar Validación</button>
                </div>
            </div>
        </div>
    </div>
</div>
