<?php

namespace Cirote\Estrategias\Actions;

use Cirote\Estrategias\Interfaces\IolInterface;
use Cirote\Estrategias\Models\Subyacente;

class LeerDatosAction
{
	private $interface;

	private $acciones;

	private $opciones;

	private $activos = [];

	private $activos_por_sigla = [];

	public function __construct(IolInterface $interface)
	{
		$this->interface = $interface;
	}

    public function __invoke()
    {
    	$startedAt = microtime(true);

    	if (! $this->activos)
    	{
    		$this->acciones = $this->interface->getAcciones();

			$this->opciones = $this->interface->getOpciones();

	    	$startedAt = microtime(true);

    		$this->crearActivos();

    		$this->agregarDatosActivos();

    		$this->agregarOpciones();
    	}

		$finishedAt = microtime(true);

		echo 'Tiempo: ' . ($finishedAt - $startedAt);

    	return $this->activos;
    }

    private function crearActivos()
    {
    	foreach ($this->datosActivos() as $activo)
    	{
    		$ticker = $activo[0];

    		$sigla = $activo[1];

    		$activo = new Subyacente(['tickerOpcion' => $sigla]);

    		$this->activos[$ticker] = $activo;

    		$this->activos_por_sigla[$sigla] = $activo;
    	}
    }

    private function agregarDatosActivos()
    {
    	foreach ($this->acciones as $activo)
    	{
    		$ticker = $activo['simbolo'];

    		if (isset($this->activos[$ticker]))
    		{
    			$this->activos[$ticker]->addAttributes($activo);
    		}
    	}
    }

    private function agregarOpciones()
    {
    	foreach ($this->opciones as $activo)
    	{
    		$ticker = substr($activo['simbolo'], 0, 3);

    		if (isset($this->activos_por_sigla[$ticker]))
    		{
    			$this->activos_por_sigla[$ticker]->addOpcion($activo);
    		}
    	}
    }

    private function datosActivos()
    {
    	return [
    		['GGAL', 'GFG'],
    		['PGR', 'PGR'],
    		['SUPV', 'SUP'],
    		['TXAR', 'TXA'],
    		['YPFD', 'YPF'],
    	];
    }
}