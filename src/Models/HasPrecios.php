<?php

namespace Cirote\Estrategias\Models;

trait HasPrecios
{
	private function precioCompra() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['precioVenta'];
		}

		return null;
	}

	private function precioVenta() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['precioCompra'];
		}

		return null;
	}

	private function precioUltimo() 
  	{
		return $this->attributes['ultimoPrecio'] ?? null;
	}

	private function precioSpread() 
  	{
  		if (! $this->precioVenta())
  		{
  			return null;
  		}

  		if (! $this->precioCompra())
  		{
  			return null;
  		}

  		return $this->precioCompra() - $this->precioVenta();
	}
}
