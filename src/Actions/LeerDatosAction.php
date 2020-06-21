<?php

namespace Cirote\Estrategias\Actions;

use Illuminate\Support\Facades\Cache;
use Cirote\Opciones\Actions\CalcularStrikeOpcionAction;
use Cirote\Opciones\Actions\CalcularVencimientoOpcionAction;
use Cirote\Estrategias\Interfaces\IolInterface;
use Cirote\Estrategias\Models\Contenedor;
use Cirote\Estrategias\Models\Subyacente;
use Cirote\Estrategias\Models\Call;
use Cirote\Estrategias\Models\Put;

class LeerDatosAction
{
	private $interface;

    private $datos;

	private $acciones;

	private $opciones;

    private $calcularStrike;

    private $calcularVencimiento;

	public function __construct(Contenedor $contenedor, IolInterface $interface)
	{
		$this->interface = $interface;

        $this->datos = &$contenedor->datos;

        $this->calcularStrike = App()->make(CalcularStrikeOpcionAction::class);

        $this->calcularVencimiento = App()->make(CalcularVencimientoOpcionAction::class);
	}

    public function execute()
    {
        if (Cache::has('datos_base_1')) 
        {
            $this->datos = Cache::get('datos_base_1');

            return $this->datos;
        }

        return Cache::remember('datos_base_1', 60 * 60, function () 
        {
            $startedAt = microtime(true);

            if (! isset($this->datos['Activos por ticker']))
            {
                $this->acciones = $this->interface->getAcciones();

                $this->opciones = $this->interface->getOpciones();

                $startedAt = microtime(true);

                $this->crearActivos();

                $this->agregarDatosActivos();

                $this->agregarOpciones();
            }

            $finishedAt = microtime(true);

            $this->datos['Tiempo de proceso'] = ($finishedAt - $startedAt);

            return $this->datos;
        });
    }

    private function crearActivos()
    {
    	foreach ($this->datosActivos() as $activo)
    	{
    		$ticker = $activo[0];

    		$sigla = $activo[1];

    		$activo = new Subyacente(['tickerOpcion' => $sigla]);

            $this->datos['Activos por ticker'][$ticker] = $activo;

            $this->datos['Activos por sigla'][$sigla] = $activo;
    	}
    }

    private function agregarDatosActivos()
    {
    	foreach ($this->acciones as $activo)
    	{
    		$ticker = $activo['simbolo'];

    		if (isset($this->datos['Activos por ticker'][$ticker]))
    		{
    			$this->datos['Activos por ticker'][$ticker]->addAttributes($activo);
    		}
    	}
    }

    private function agregarOpciones()
    {
    	foreach ($this->opciones as $opcion)
    	{
    		$sigla = substr($opcion['simbolo'], 0, 3);

    		if (isset($this->datos['Activos por sigla'][$sigla]))
    		{
                $this->crearOpcion($sigla, $opcion);
    		}
    	}
    }

    private function crearOpcion($sigla, $attributes = [])
    {
        $ticker = substr($attributes['simbolo'], 4);

        $tipo = substr($attributes['simbolo'], 3, 1);

        $subyacente = $this->datos['Activos por sigla'][$sigla];

        $attributes['precioEjercicio'] = $this->calcularStrike->execute($attributes['simbolo']);

        $attributes['fechaVencimiento'] = $this->calcularVencimiento->execute($attributes['simbolo']);

        if ($tipo == 'C')
        {
            $opcion = new Call($subyacente, $attributes);

        } else {

            $opcion = new Put($subyacente, $attributes);
        }

        $this->datos['Opciones por sigla'][$sigla][$ticker][$tipo] = $opcion;
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