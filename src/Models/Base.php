<?php

namespace Cirote\Estrategias\Models;

use Cirote\Estrategias\Actions\CrearBasesAction as ObtenerBases;

class Base
{
	use HasAttributes;

	private $call;

	private $put;

	private $sintetica;

	public static function all()
	{
		$obtenerBases = resolve(ObtenerBases::class);

        return collect($obtenerBases->execute())->sort(function($a, $b) 
        {
	    	if ($a->orderString() == $b->orderString()) 
	    	{
	        	return 0;
	    	}

    		return ($a->orderString() < $b->orderString()) ? -1 : 1;
		});
	}

	public static function serie($ticker, $mes)
	{
		return static::all()->filter(function ($base, $key) use ($ticker, $mes)
        {
        	return ($base->subyacente->simbolo == $ticker) AND ($base->mes == $mes);	
		});
	}

	public function __construct(?Call $call, ?Put $put)
	{
		$this->call = $call;

		$this->put = $put;

		if ($call)
		{
			if ($put)
			{
				if (($put->cantidadVenta AND $call->cantidadCompra) OR ($call->cantidadVenta AND $put->cantidadCompra))
				{
					$this->sintetica = new Sintetica($call, $put);
				}
			}			
		}
	}

	private function orderString()
	{
		return $this->subyacente->simbolo . (1000 + $this->strike) . $this->mes;
	}

	private function subyacente()
	{
		if ($this->put)
		{
			return $this->put->subyacente;
		}

		return $this->call->subyacente;
	}

	private function base()
	{
		return $this->base;
	}

	private function strike()
	{
		if ($this->put)
		{
			return $this->put->strike;
		}

		return $this->call->strike;
	}

	private function mes()
	{
		if ($this->put)
		{
			return $this->put->fechaVencimiento->format('m');
		}

		return $this->call->fechaVencimiento->format('m');
	}

	private function ano()
	{
		if ($this->put)
		{
			return $this->put->fechaVencimiento->format('Y');
		}

		return $this->call->fechaVencimiento->format('Y');
	}

	private function call()
	{
		return $this->call;
	}

	private function put()
	{
		return $this->put;
	}

	private function sintetica()
	{
		return $this->sintetica;
	}
}
