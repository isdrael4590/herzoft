<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>QR ETIQUETAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/printer/css/bootstrap.min.css') }}">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/printer/css/style.css') }}">
</head>

<body>
    <div class="container">
        @if(session()->has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="printer-16 printer-content">
                @include('labelqr::labelqrs.print-only', [
                    'labelqr' => $labelqr,
                    'labelqrDetails' => $labelqrDetails,
                    'institute' => $institute,
                ])
            </div>
            <div class="printer-btn-section clearfix d-print-none">
                <a href="{{ route('labelqrs_label.img', $labelqr->id) }}" class="btn btn-lg btn-print">
                    Imprimir
                </a>
        </div>
        </div>
    </div>
</body>

</html>
