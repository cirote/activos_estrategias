<?php

namespace Cirote\Opciones\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cirote\Opciones\Config\Config;
use Cirote\Opciones\Models\Call;

use App\Models\Activos\Activo;

class EstrategiasController extends Controller
{
	public function lanzamiento_cubierto()
    {
        return view('opciones::opciones.index')
            ->withActivos(Call::with('precio', 'ticker', 'subyacente')
                ->has('precio')
                ->get()
                ->paginate(Config::ELEMENTOS_POR_PAGINA)
            );
    }
}
