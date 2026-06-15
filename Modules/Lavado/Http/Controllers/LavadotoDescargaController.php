<?php

namespace Modules\Lavado\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Lavado\Entities\Lavado;

class LavadotoDescargaController extends Controller
{
    public function __invoke(Lavado $lavado)
    {
        abort_if(Gate::denies('create_wash_area'), 403);

        $lavado->load('lavadoDetalles');

        return view('lavado::descarga-lavado.create', [
            'lavado'       => $lavado,
            'lavado_id'    => $lavado->id,
            'reception_id' => $lavado->reception_id,
        ]);
    }
}
