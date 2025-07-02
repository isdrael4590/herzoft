{{-- Elemento raíz único para Livewire --}}
<div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Barcode Generator</h5>
        </div>

        <div class="card-body">
            {{-- Mensajes de Flash --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Información del Producto Seleccionado --}}
            @if ($product)
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card bg-light">
                            <div class="card-body py-3">
                                <h6 class="card-title mb-2">Selected Product</h6>
                                <p class="mb-1"><strong>Name:</strong> {{ $product->product_name ?? 'N/A' }}</p>
                                <p class="mb-1"><strong>Code:</strong>
                                    {{ $product->product_code ?? 'N/A' }}
                                </p>
                                <p class="mb-0"><strong>Symbology:</strong>
                                    {{ $product->product_barcode_symbology ?? 'C128' }}</p>

                                @can('access_admin')
                                    {{-- Información de debugging --}}
                                    <small class="text-muted">
                                        Debug: Code length: {{ strlen($product->product_code ?? '') }} chars
                                    </small>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" wire:model="quantity"
                                min="1" max="100" placeholder="Enter quantity">
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary me-2" wire:click="generateBarcodes"
                            wire:loading.attr="disabled" {{ $quantity <= 0 ? 'disabled' : '' }}>
                            <span wire:loading.remove wire:target="generateBarcodes">
                                <i class="fas fa-barcode me-1"></i> Generate Barcodes
                            </span>
                            <span wire:loading wire:target="generateBarcodes">
                                <i class="fas fa-spinner fa-spin me-1"></i> Generating...
                            </span>
                        </button>
                        @can('access_admin')
                            {{-- Botón de debug --}}
                            <button type="button" class="btn btn-warning me-2" wire:click="debugBarcodes">
                                <i class="fas fa-bug me-1"></i> Debug
                            </button>
                        @endcan
                        @if (count($barcodes) > 0)
                            <button type="button" class="btn btn-success me-2" wire:click="downloadPdf"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="downloadPdf">
                                    <i class="fas fa-download me-1"></i> Download PDF
                                </span>
                                <span wire:loading wire:target="downloadPdf">
                                    <i class="fas fa-spinner fa-spin me-1"></i> Generating PDF...
                                </span>
                            </button>

                            <button type="button" class="btn btn-info me-2" wire:click="previewPdf"
                                wire:loading.attr="disabled" target="_blank">
                                <span wire:loading.remove wire:target="previewPdf">
                                    <i class="fas fa-eye me-1"></i> Preview PDF
                                </span>
                                <span wire:loading wire:target="previewPdf">
                                    <i class="fas fa-spinner fa-spin me-1"></i> Loading Preview...
                                </span>
                            </button>
                        @endif
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Please select a product to generate barcodes.
                </div>
            @endif

            {{-- Vista Previa de Códigos de Barras --}}
            @if (count($barcodes) > 0)
                <div class="mt-4">
                    <h6 class="mb-3">Generated Barcodes ({{ count($barcodes) }})</h6>
                    @can('access_admin')
                        {{-- Información de debugging --}}
                        <div class="alert alert-info mb-3">
                            <small>
                                <strong>Debug Info:</strong><br>
                                Total barcodes: {{ count($barcodes) }}<br>
                                @if (count($barcodes) > 0)
                                    First barcode code: {{ $barcodes[0]['code'] ?? 'N/A' }}<br>
                                    Has HTML: {{ !empty($barcodes[0]['html'] ?? '') ? 'Yes' : 'No' }}<br>
                                    HTML length: {{ strlen($barcodes[0]['html'] ?? '') }} chars
                                @endif
                            </small>
                        </div>
                    @endcan
                    <div class="row">
                        @foreach ($barcodes as $index => $barcode)
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <div class="card text-center">
                                    <div class="card-body py-2">
                                        <div class="barcode-preview-grid mb-1">
                                            @if (!empty($barcode['html'] ?? ''))
                                                {!! $barcode['html'] !!}
                                            @else
                                                <div class="alert alert-warning p-1">
                                                    <small>No barcode HTML</small>
                                                </div>
                                            @endif
                                        </div>
                                        @if (isset($barcode['description']))
                                            <p class="mb-0 small text-muted">
                                                {{ Str::limit($barcode['description'], 20) }}</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
{{-- Estilos integrados --}}

@push('page_scripts')
    <style>
        .barcode-preview-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80px;
            padding: 0.5rem;
        }

        .barcode-preview-flex svg {
            max-width: 100%;
            height: auto;
            max-height: 60px;
            display: block;
        }

        /* OPCIÓN 2: Con fondo mejorado */
        .barcode-preview-enhanced {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80px;
            padding: 0.5rem;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }

        .barcode-preview-enhanced svg {
            max-width: 100%;
            height: auto;
            max-height: 60px;
            display: block;
        }

        /* OPCIÓN 3: Grid */
        .barcode-preview-grid {
            display: grid;
            place-items: center;
            min-height: 80px;
            padding: 0.5rem;
        }

        .barcode-preview-grid svg {
            max-width: 100%;
            height: auto;
            max-height: 60px;
        }

        /* Estilos comunes para todos */
        .barcode-preview-flex .alert,
        .barcode-preview-enhanced .alert,
        .barcode-preview-grid .alert {
            margin: 0;
            font-size: 0.75rem;
        }
    </style>
@endpush
