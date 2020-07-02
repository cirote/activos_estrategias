<?php

namespace Cirote\Estrategias\Models;

class Bull
{
	use HasAttributes;

	protected $comprada;

	protected $vendida;

	public function __construct(Opcion $comprada, Opcion $vendida)
	{
    if ($comprada->strike > $vendida->strike)
    {
      dump('Error: Call con opciones invertidas');

      dump($comprada);

      dd($venta);
    }

		$this->comprada = $comprada;

		$this->vendida = $vendida;
	}

  protected function rango() 
  {
    return $this->vendida->strike - $this->comprada->strike;
  }
}
