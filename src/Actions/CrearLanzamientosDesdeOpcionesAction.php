<?php

namespace Cirote\Estrategias\Actions;

use Illuminate\Support\Collection;
use Cirote\Estrategias\Models\Lanzamiento;

class CrearLanzamientosDesdeOpcionesAction
{
    public function __invoke(Collection $opciones): Collection
    {
    	return $opciones->map(function ($opcion) 
        {
            return new Lanzamiento($opcion);
        });
    }
}