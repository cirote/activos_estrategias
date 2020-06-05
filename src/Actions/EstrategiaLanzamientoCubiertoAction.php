<?php

namespace Cirote\Estrategias\Actions;

use Illuminate\Support\Collection;
use Cirote\Estrategias\Actions\LeerDatosAction;
use Cirote\Estrategias\Models\Lanzamiento;

class EstrategiaLanzamientoCubiertoAction
{
	private $leerDatos;

	private $lanzamientos;

    public function __construct()
    {
    	$this->leerDatos = resolve(LeerDatosAction::class);
    }

    public function execute()
    {
    	if (! $this->lanzamientos)
        {
            $this->crearLanzamientos();
        }

        return $this->lanzamientos;
    }

    private function crearLanzamientos()
    {
    	foreach($this->leerDatos->execute() as $subyacente)
    	{
	    	foreach($subyacente->opciones() as $opciones)
	    	{
	    		if (isset($opciones['C']))
	    		{
			    	$this->lanzamientos[] = new Lanzamiento($opciones['C']);	
	    		}
	    	}
    	}
    }
}