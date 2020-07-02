<?php

namespace Cirote\Estrategias\Models;

class BearPut extends Bear
{
	public function __construct(Put $comprada, Put $vendida)
	{
    parent::__construct($comprada, $vendida);
	}

  protected function perdidaMaxima() 
  {
    if (! $this->comprada->precioCompra)
    {
      return null;
    }

    if (! $this->vendida->precioVenta)
    {
      return null;
    }

    return $this->diferenciaPrimas();
  }

  protected function gananciaMaxima() 
  {
    if (! $this->comprada->precioCompra)
    {
      return null;
    }

    if (! $this->vendida->precioVenta)
    {
      return null;
    }

    return $this->rango() - $this->diferenciaPrimas();
  }

  protected function precioEquilibrio() 
  {
    return $this->comprada->strike + $this->diferenciaPrimas();
  }

  protected function diferenciaPrimas() 
  {
    return $this->comprada->precioCompra - $this->vendida->precioVenta;
  }
}
