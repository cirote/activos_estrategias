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

		dd($spreads[0]);
	}

	public function __construct(Base $base1, Base $base2)
	{
		if ($base1->call AND $base2->call)
		{
			$this->call_bajo = $base1->call;

			$this->call_alto = $base2->call;

			$this->subyacente = $base1->call->subyacente;

			$this->bull_call = new Bull($base1->call, $base2->call);

			$this->bear_call = new Bear($base1->call, $base2->call);
		}

		if ($base1->put AND $base2->put)
		{
			$this->put_bajo = $base1->put;

			$this->put_alto = $base2->put;

			$this->subyacente = $base1->put->subyacente;

			$this->bull_put = new Bull($base1->put, $base2->put);

			$this->bear_put = new Bear($base1->put, $base2->put);
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

	private function precioCompra() 
  	{
  		$precio_call = $this->bear_call
  			? $this->bear_call->precioCompra
  			: 0;

  		$precio_put = $this->bear_put 
  			? $this->bear_put->precioCompra
  			: 0;

		return max($precio_call, $precio_put);
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