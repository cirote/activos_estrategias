<?php

namespace Cirote\Estrategias\Models;

class Bull
{
	use HasAttributes;

	private $comprada;

	private $vendida;

	public function __construct(Opcion $comprada, Opcion $vendida)
	{
		$this->comprada = $comprada;

		$this->vendida = $vendida;
	}

	private function precioCompra() 
  	{
  		if (! $this->comprada->precioCompra)
  		{
  			return 0;
  		}

  		if (! $this->vendida->precioVenta)
  		{
  			return 0;
  		}

  		return $this->vendida->precioVenta - $this->comprada->precioCompra;
	}

	private function precioVenta() 
  	{
  		if (! $this->comprada->precioVenta)
  		{
  			return 0;
  		}

  		if (! $this->vendida->precioCompra)
  		{
  			return 0;
  		}

  		return $this->comprada->precioVenta - $this->vendida->precioCompra;
	}
}