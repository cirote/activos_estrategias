<?php

namespace Cirote\Estrategias\Controllers;

use App\Http\Controllers\Controller;
use Cirote\Opciones\Config\Config;

use Cirote\Estrategias\Models\Contenedor;
use Cirote\Estrategias\Models\Base;
use Cirote\Estrategias\Models\Lanzamiento;

class EstrategiasController extends Controller
{
    public function bases()
    {
        return view('estrategias::estrategias.bases')
            ->withBases(Base::all()->paginate(Config::ELEMENTOS_POR_PAGINA));
    }

	public function lanzamiento_cubierto()
    {
        return view('estrategias::estrategias.lanzamientos')
            ->withLanzamientos(Lanzamiento::all()->paginate(Config::ELEMENTOS_POR_PAGINA));
    }

    public function tester()
    {
//dd(resolve(Contenedor::class));

        $lanzamientos = Lanzamiento::all();
        
//dd(resolve(Contenedor::class)->getDatos());
        return view('estrategias::estrategias.lanzamientos')
            ->withLanzamientos($lanzamientos->paginate(Config::ELEMENTOS_POR_PAGINA));

        dd(
            $lanzamientos
        );
    }
}
