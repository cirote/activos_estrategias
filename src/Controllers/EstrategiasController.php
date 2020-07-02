<?php

namespace Cirote\Estrategias\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Cirote\Opciones\Config\Config;

use Cirote\Estrategias\Models\Contenedor;
use Cirote\Estrategias\Models\Base;
use Cirote\Estrategias\Models\Lanzamiento;
use Cirote\Estrategias\Models\Spread;

class EstrategiasController extends Controller
{
    public function bases_nuevas()
    {
        Cache::forget('datos_base');

        return redirect()->route('estrategias.bases');
    }

    public function bases()
    {
        return view('estrategias::estrategias.bases')
            ->withBases(Base::all()->paginate(Config::ELEMENTOS_POR_PAGINA));
    }

    public function spreads()
    {
        //  Cache::forget('datos_base');

        return view('estrategias::estrategias.spreads')
            ->withBases(Spread::optimos()->paginate(Config::ELEMENTOS_POR_PAGINA));
    }

	public function lanzamiento_cubierto()
    {
        return view('estrategias::estrategias.lanzamientos')
            ->withLanzamientos(Lanzamiento::all()->paginate(Config::ELEMENTOS_POR_PAGINA));
    }

    public function tester()
    {
        $spreads = Spread::all();
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
