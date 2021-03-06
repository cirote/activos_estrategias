<?php

namespace Cirote\Estrategias\Actions;

use Illuminate\Support\Collection;
use Cirote\Estrategias\Actions\LeerDatosAction;
use Cirote\Estrategias\Models\Base;

class CrearBasesAction
{
	private $leerDatos;

	private $bases;

    public function __construct()
    {
    	$this->leerDatos = resolve(LeerDatosAction::class);
    }

    public function execute()
    {
    	if (! $this->bases)
        {
            $this->crearBases();
        }

        return $this->bases;
    }

    private function crearBases()
    {
    	foreach($this->leerDatos->execute()['Activos por ticker'] as $subyacente)
    	{
	    	foreach($subyacente->opciones() as $base => $opciones)
	    	{
                if (isset($opciones['C']) OR isset($opciones['V']))
                {
                    $this->bases[] = new Base($opciones['C'] ?? null, $opciones['V'] ?? null);   
                }
	    	}
    	}
    }
}