<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Barcodes' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.2;
            background: white;
            color: black;
        }

        .barcode-container {
            width: 100%;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .barcode-item {
            width: 70mm;
            height: 35mm;
            border: 1px solid #000;
            margin: 2mm;
            padding: 3mm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            page-break-inside: avoid;
            background: white;
            position: relative;
        }

        .barcode-code {
            font-size: 11px;
            font-weight: bold;
            color: #000;
            margin-bottom: 3mm;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-align: center;
        }

        .barcode-svg-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 62mm;
            margin: 2mm 0;
            min-height: 18mm;
            max-height: 20mm;
        }

        .barcode-svg-container svg {
            width: 100% !important;
            height: 100% !important;
            max-width: 62mm !important;
            min-height: 18mm !important;
            max-height: 20mm !important;
        }

        .barcode-description {
            font-size: 9px;
            color: #333;
            margin-top: 2mm;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: normal;
            text-align: center;
        }

        .barcode-fallback {
            font-family: 'Courier New', monospace;
            font-size: 10px;
            letter-spacing: 1px;
            border: 1px solid #ccc;
            padding: 3mm;
            background: #f9f9f9;
            color: #333;
            width: 100%;
            text-align: center;
            min-height: 18mm;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .no-barcode {
            color: #999;
            font-style: italic;
            font-size: 10px;
        }

        /* Estilos específicos para el SVG del código de barras */
        svg rect {
            fill: #000 !important;
        }

        svg text {
            font-size: 10px !important;
            font-family: 'DejaVu Sans', Arial, sans-serif !important;
            fill: #000 !important;
        }

        /* Mejorar la visibilidad del código de barras */
        .barcode-svg-container svg g rect {
            fill: #000 !important;
        }

        .barcode-svg-container svg g text {
            font-size: 10px !important;
            font-weight: bold !important;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            .barcode-container {
                padding: 5mm;
            }

            .barcode-item {
                margin: 1mm;
                border: 0.5pt solid #000;
            }

            .barcode-svg-container svg {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }

        @page {
            margin: 5mm;
            size: A4 portrait;
        }
    </style>
</head>

<body>
    <div class="barcode-container">
        @if (isset($barcodes) && is_array($barcodes) && count($barcodes) > 0)
            @foreach ($barcodes as $index => $barcode)
                <div class="barcode-item">
                    {{-- Código del producto --}}
                    <div class="barcode-code">
                        @if (isset($barcode['code']) && !empty($barcode['code']))
                            {{ $barcode['code'] }}
                        @else
                            BARCODE-{{ $index + 1 }}
                        @endif
                    </div>

                    {{-- Código de barras SVG --}}
                    <div class="barcode-svg-container">
                        @if (isset($barcode['html']) && !empty($barcode['html']))
                            {!! $barcode['html'] !!}
                        @elseif(isset($barcode['code']) && !empty($barcode['code']))
                            {{-- Generate barcode SVG if only code is provided --}}
                            @try
                                {!! \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG(
                                    $barcode['code'], 
                                    $barcode['symbology'] ?? 'C128', 
                                    3, 
                                    80,
                                    'black',
                                    true
                                ) !!}
                            @catch(\Exception $e)
                                <div class="barcode-fallback">
                                    {{ $barcode['code'] }}
                                    <br><small style="color: #999;">Barcode generation failed</small>
                                </div>
                            @endtry
                        @else
                            <div class="barcode-fallback no-barcode">
                                NO BARCODE DATA
                            </div>
                        @endif
                    </div>

                    {{-- Descripción del producto --}}
                    @if (isset($barcode['description']) && !empty($barcode['description']))
                        <div class="barcode-description">
                            {{ Str::limit($barcode['description'], 35) }}
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            {{-- Mensaje cuando no hay códigos de barras --}}
            <div class="barcode-item">
                <div class="barcode-code">NO DATA</div>
                <div class="barcode-svg-container">
                    <div class="barcode-fallback no-barcode">
                        No barcodes available for printing
                    </div>
                </div>
                <div class="barcode-description">
                    Please generate barcodes first
                </div>
            </div>
        @endif
    </div>
</body>

</html>