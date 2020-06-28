<?php

namespace Cirote\Estrategias\Models;

class Bear
{
	use HasAttributes;

	private $comprada;

	private $vendida;

	public function __construct(Opcion $vendida, Opcion $comprada)
	{
		$this->comprada = $comprada;

		$this->vendida = $vendida;
	}

	private function precioCompra() 
  	{
  		if (! $this->comprada->precioVenta)
  		{
  			return 0;
  		}

  		if (! $this->vendida->precioCompra)
  		{
  			return 0;
  		}

  		return $this->vendida->precioCompra - $this->comprada->precioVenta;
	}

	private function precioVenta() 
  	{
  		if (! $this->comprada->precioCompra)
  		{
  			return 0;
  		}

  		if (! $this->vendida->precioVenta)
  		{
  			return 0;
  		}

  		return $this->comprada->precioCompra - $this->vendida->precioVenta;
	}
}