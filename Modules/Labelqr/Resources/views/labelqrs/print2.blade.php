<!DOCTYPE html>
<html lang="es">
@include('labelqr::partials.print-styles')
<body>
    @foreach ($labelqr->labelqrDetails as $item)
        @for ($i = 1; $i <= $item->product_quantity; $i++)
            <div style="page-break-after:always;">
                @include('labelqr::partials.label-card-barcode3')
            </div>
        @endfor
    @endforeach
</body>
</html>
