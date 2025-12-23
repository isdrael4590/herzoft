@if($data->preparationDetails->count() > 0)
    <div class="small">
        @foreach($data->preparationDetails->take(3) as $detail)
            <div class="mb-1">
                <code class="me-1">{{ $detail->product_code }}</code>
                <span class="text-truncate d-inline-block" style="max-width: 150px;">
                    {{ $detail->product_name }}
                </span>
                <span class="badge bg-success ms-1">{{ $detail->product_quantity }}</span>
            </div>
        @endforeach
        
        @if($data->preparationDetails->count() > 3)
            <div class="text-muted small">
                <i class="bi bi-three-dots"></i> y {{ $data->preparationDetails->count() - 3 }} más
            </div>
        @endif
    </div>
@else
    <span class="text-muted small">
        <i class="bi bi-inbox"></i> Sin productos
    </span>
@endif