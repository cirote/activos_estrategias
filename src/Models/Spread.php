<?php

namespace Cirote\Estrategias\Models;

use Illuminate\Support\Collection;

class Spread
{
	use HasAttributes, HasPrecios;

	private $subyacente = null;

	private $call_bajo = null;

	private $call_alto = null;

	private $put_bajo = null;

	private $put_alto = null;

	private $bull_call = null;

	private $bull_put = null;

	private $bear_call = null;

	private $bear_put = null;

	public static function all()
	{
		$bases = Base::all();

		$spreads = [];

		$subyacente_anterior = null;

		foreach($bases as $base)
		{
			if ($subyacente_anterior !== $base->subyacente)
			{
				$socios = [];
			}

			foreach($socios as $socio)
			{
				if ($base->mes == $socio->mes)
				{
					$spreads[] = new static($socio, $base);
				}
			}

			$socios[] = $base;

			$subyacente_anterior = $base->subyacente;
		}

		return collect($spreads);
	}

	public static function optimos()
	{
		return static::all()->filter(function ($spread, $key) 
        {
        	return $spread->gananciaPorcentual() > 2;
		
		})->sort(function($a, $b) 
        {
	    	if ($a->gananciaPorcentual() == $b->gananciaPorcentual()) 
	    	{
	        	return 0;
	    	}

    		return ($a->gananciaPorcentual() < $b->gananciaPorcentual()) ? 1 : -1;
		});

	}

	public function __construct(Base $base1, Base $base2)
	{
		if ($base1->call AND $base2->call)
		{
			$this->call_bajo = $base1->call;

			$this->call_alto = $base2->call;

			$this->subyacente = $base1->call->subyacente;

			$this->bull_call = new BullCall($base1->call, $base2->call);

			$this->bear_call = new BearCall($base1->call, $base2->call);
		}

		if ($base1->put AND $base2->put)
		{
			$this->put_bajo = $base1->put;

			$this->put_alto = $base2->put;

			$this->subyacente = $base1->put->subyacente;

			$this->bull_put = new BullPut($base1->put, $base2->put);

			$this->bear_put = new BearPut($base1->put, $base2->put);
		}
	}

	private function subyacente()
	{
		return $this->subyacente;
	}

	private function call_bajo()
	{
		return $this->call_bajo;
	}

	private function call_alto()
	{
		return $this->call_alto;
	}

	private function put_bajo()
	{
		return $this->put_bajo;
	}

	private function put_alto()
	{
		return $this->put_alto;
	}

	private function bull_put()
	{
		return $this->bull_put;
	}

	private function bear_call()
	{
		return $this->bear_call;
	}

	private function bear_put()
	{
		return $this->bear_put;
	}

	private function bull_call()
	{
		return $this->bull_call;
	}

	private function strike_bajo() 
  	{
		if ($this->put_bajo)
		{
			return $this->put_bajo->strike;
		}

		if ($this->call_bajo)
		{
			return $this->call_bajo->strike;
		}

		return 0;
	}

	private function strike_alto() 
  	{
		if ($this->put_alto)
		{
			return $this->put_alto->strike;
		}

		if ($this->call_alto)
		{
			return $this->call_alto->strike;
		}

		return 0;
	}

	private function rango() 
	{
		return $this->strike_alto() - $this->strike_bajo();
	}

	protected function gananciaMaximaBull() 
	{
		$bullCall = ($this->bull_call())
			? $this->bull_call()->gananciaMaxima
			: 0;

		$bullPut = ($this->bull_put())
			? $this->bull_put()->gananciaMaxima
			: 0;

		return max($bullCall, $bullPut);
	}

	protected function gananciaMaximaBear()
	{
		$bearCall = ($this->bear_call())
			? $this->bear_call()->gananciaMaxima
			: 0;

		$bearPut = ($this->bear_put())
			? $this->bear_put()->gananciaMaxima
			: 0;

		return max($bearCall, $bearPut);
	}

	protected function gananciaMaxima()
	{
		return $this->gananciaMaximaBull() + $this->gananciaMaximaBear();
	}

	protected function gananciaPorcentual() 
  	{
  		if (! $this->rango())
  		{
  			return null;
  		}

		return (($this->gananciaMaxima() / $this->rango()) - 1) * 100;
	}

	private function precioVenta() 
  	{
  		$precio_call = $this->bull_call 
  			? $this->bull_call->precioVenta
  			: 999999;

  	  	$precio_put = $this->bull_put 
  			? $this->bull_put->precioVenta
  			: 999999;

  		return min($precio_call, $precio_put);
	}
}