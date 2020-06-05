<?php

namespace Cirote\Estrategias\Models;

use Cirote\Opciones\Actions\CalcularStrikeOpcionAction;
use Cirote\Opciones\Actions\CalcularVencimientoOpcionAction;
use Cirote\Estrategias\Models\Opcion;
use Cirote\Estrategias\Models\Call;
use Cirote\Estrategias\Models\Put;

class Subyacente
{
	private $attributes = [];

	private $opciones = [];

	private $calcularStrike;

	private $calcularVencimiento;

	public function __construct($attributes = [])
	{
		$this->attributes = $attributes;

        $this->calcularStrike = App()->make(CalcularStrikeOpcionAction::class);

        $this->calcularVencimiento = App()->make(CalcularVencimientoOpcionAction::class);
	}

	public function addAttributes($attributes = [])
	{
		$this->attributes = array_merge($this->attributes, $attributes);
	}

	public function addOpcion($attributes = [])
	{
		$ticker = substr($attributes['simbolo'], 4);

		$tipo = substr($attributes['simbolo'], 3, 1);

		$attributes['precioEjercicio'] = $this->calcularStrike->execute($attributes['simbolo']);

		$attributes['fechaVencimiento'] = $this->calcularVencimiento->execute($attributes['simbolo']);

		if ($tipo == 'C')
		{
			$opcion = new Call($this, $attributes);

		} else {

			$opcion = new Put($this, $attributes);
		}

		$this->opciones[$ticker][$tipo] = $opcion;
	}

	public function opciones()
	{
		return $this->opciones;
	}

	public function precioVenta() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['precioVenta'];
		}

		return 0;
	}

	public function simbolo() 
  	{
		return $this->attributes['simbolo'];
	}
}