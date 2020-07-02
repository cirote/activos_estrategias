<?php

namespace Cirote\Estrategias\Models;

class Bear
{
	use HasAttributes;

	protected $comprada;

	protected $vendida;

	public function __construct(Opcion $vendida, Opcion $comprada)
  {
    if ($comprada->strike < $vendida->strike)
    {
      dump('Error: Put con opciones invertidas');

      dump($comprada);

      dd($venta);
    }

    $this->comprada = $comprada;

    $this->vendida = $vendida;
  }

  protected function rango() 
  {
    return $this->comprada->strike - $this->vendida->strike;
  }
}