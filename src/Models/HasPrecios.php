<?php

namespace Cirote\Estrategias\Models;

trait HasPrecios
{
	private function precioCompra() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['precioCompra'];
		}

		return 0;
	}

	private function precioVenta() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['precioVenta'];
		}

		return 0;
	}

	private function precioUltimo() 
  	{
		return $this->attributes['ultimoPrecio'] ?? 0;
	}

	private function precioSpread() 
  	{
  		if (! $this->precioVenta())
  		{
  			return 0;
  		}

  		if (! $this->precioCompra())
  		{
  			return 0;
  		}

  		return $this->precioVenta() - $this->precioCompra();
	}
}
