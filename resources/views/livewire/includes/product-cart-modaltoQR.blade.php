<div class="d-inline-block">
    <!-- Button trigger Discount Modal -->
    <span
        wire:click="$dispatch('InputWrap_packageRefresh', { product_id: {{ $cart_item->id }}, row_id: '{{ $cart_item->rowId }}' })"
        role="button" class="badge badge-warning pointer-event" data-toggle="modal"
        data-target="#InputWrap_package{{ $cart_item->id }}">
        <i class="bi bi-pencil-square text-white"></i>
    </span>
    <!-- Discount Modal -->
    <div wire:ignore.self class="modal fade" id="InputWrap_package{{ $cart_item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="InputWrap_packageLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="InputWrap_packageLabel">
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
                    @if (session()->has('message_InputWrap_package' . $cart_item->id))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="alert-body">
                                <span>{{ session('message_InputWrap_package' . $cart_item->id) }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Tipo de envoltura <span class="text-danger">*</span></label>
                        <select wire:model.live="package_wrap.{{ $cart_item->id }}" class="form-control" required>
                            <option disabled>-- Seleccionar la envoltura--</option>
                            <option selected value="Contenedor"> Contenedor Rígido</option>
                            <option value="Papel Mixto"> Papel Mixto </option>
                            <option value="Papel Tyvek"> Papel Tyvek </option>
                            <option value="Tela No Tejida"> Tela No Tejida </option>
                            <option value="Tela Tejida (SMS)"> Tela Tejida (SMS)</option>
                            <option value="Otro"> Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Validación del Embalaje <span class="text-danger">*</span></label>
                        <select wire:model.live="eval_package.{{ $cart_item->id }}" class="form-control" required>
                            <option disabled>-- Seleccionar la envoltura--</option>
                            <option value="N/A"> N/A </option>
                            <option selected value="OK"> OK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Elegir Ind. Químico tipo 4 ó 5 <span class="text-danger">*</span></label>
                        <select wire:model.live="eval_indicator.{{ $cart_item->id }}" class="form-control" required>
                            <option selected value="4"> 4</option>
                            <option value="5"> 5 </option>
                            <option value="N/A"> N/A </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiempo de Vencimiento <span class="text-danger">*</span></label>
                            <select wire:model.live="expiration.{{ $cart_item->id }}"  wire:model="expiration_data" class="form-control" required>
                                <option value="14" {{ $expiration_data == 14 ? 'selected' : '' }}>14 Días</option>
                                <option value="180" {{ $expiration_data == 180 ? 'selected' : '' }}>6 Meses</option>
                                <option value="270" {{ $expiration_data == 270 ? 'selected' : '' }}>9 Meses</option>
                                <option value="365" {{ $expiration_data == 365 ? 'selected' : '' }}>12 Meses</option>
                                <option value="545" {{ $expiration_data == 545 ? 'selected' : '' }}>18 Meses</option>
                               
                            </select>
                       
                    </div>

                    <div class="form-group">
                        <label>Operador de empaque</label>
                        <select wire:model.live="operator_package.{{ $cart_item->id }}"class="form-control" required>
                            @foreach (App\Models\User::all() as $user)
                                <option value="{{ $user->name }}">
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button wire:click="setProductoptions('{{ $cart_item->rowId }}', {{ $cart_item->id }})"
                        type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
