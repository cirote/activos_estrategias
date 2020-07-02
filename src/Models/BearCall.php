<?php

namespace Cirote\Estrategias\Models;

class BearCall extends Bear
{
	public function __construct(Call $comprada, Call $vendida)
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

    return $this->rango() - $this->diferenciaPrimas();
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

    return $this->diferenciaPrimas();
  }

  protected function precioEquilibrio() 
  {
    return $this->vendida->strike - $this->diferenciaPrimas();
  }

  protected function diferenciaPrimas() 
  {
    return $this->vendida->precioVenta - $this->comprada->precioCompra;
  }
}
