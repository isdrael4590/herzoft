<!DOCTYPE html>
<html lang="es">
@include('labelqr::partials.print-styles')
<body>
    @foreach ($labelqr->labelqrDetails as $item)
        <div>
            <table style="width:100%">
                <head>
                    @include('labelqr::partials.label-card-qrhpo')
                </head>
            </table>
        </div>
    @endforeach
</body>
</html>
