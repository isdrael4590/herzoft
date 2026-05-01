@if($data->descargaLavadoDetalles->isEmpty())
    <span class="text-muted">-</span>
@else
    <button type="button" class="btn btn-sm btn-outline-secondary"
        data-toggle="collapse" data-target="#des-detalles-{{ $data->id }}">
        <i class="bi bi-list-ul"></i> {{ $data->descargaLavadoDetalles->count() }} ítem(s)
    </button>
    <div id="des-detalles-{{ $data->id }}" class="collapse mt-1 text-left">
        <ul class="list-unstyled mb-0 small">
            @foreach($data->descargaLavadoDetalles as $detalle)
                <li>
                    <strong>{{ $detalle->product_code }}</strong> - {{ $detalle->product_name }}
                    <span class="badge badge-light border">x{{ $detalle->product_quantity }}</span>
                    @if($detalle->product_patient)
                        <span class="text-muted"> | {{ $detalle->product_patient }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endif
