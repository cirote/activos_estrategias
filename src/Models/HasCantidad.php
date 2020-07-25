<?php

namespace Cirote\Estrategias\Models;

trait HasCantidad
{
	private function cantidadCompra() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['cantidadVenta'];
		}

		return null;
	}

	private function cantidadVenta() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['cantidadCompra'];
		}

		return null;
	}
}
