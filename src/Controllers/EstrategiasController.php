<?php

namespace Cirote\Estrategias\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cirote\Opciones\Config\Config;
use Cirote\Opciones\Models\Call;
use Cirote\Activos\Models\Activo;
use Cirote\Estrategias\Actions\CrearLanzamientosDesdeOpcionesAction;
use Cirote\Estrategias\Interfaces\IolInterface;

class EstrategiasController extends Controller
{
	public function lanzamiento_cubierto(CrearLanzamientosDesdeOpcionesAction $crearLanzamientos)
    {
        $lanzamientos = $crearLanzamientos(
            Call::with('precio', 'ticker', 'subyacente')
                ->has('precio')
                ->get()
        )
            ->sortByDesc('TNA');

        return view('estrategias::estrategias.index')
            ->withLanzamientos($lanzamientos->paginate(Config::ELEMENTOS_POR_PAGINA));
    }

    public function tester(IolInterface $interface)
    {
        $interface();
    }
}
