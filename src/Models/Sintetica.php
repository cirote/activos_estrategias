<?php

namespace Cirote\Estrategias\Models;

//use Cirote\Estrategias\Actions\CrearBasesAction as ObtenerBases;

class Sintetica
{
	use HasAttributes, HasPrecios;

	private $call;

	private $put;

	public static function all()
	{
//		$obtenerBases = resolve(ObtenerBases::class);

//      return collect($obtenerBases->execute());
	}

	public function __construct(Call $call, Put $put)
	{
		$this->call = $call;

		$this->put = $put;
	}

	private function subyacente()
	{
		if ($this->call)
		{
			return $this->call->subyacente;
		}

		return $this->put->subyacente;
	}

	private function call()
	{
		return $this->call;
	}

	private function put()
	{
		return $this->put;
	}

	private function precioCompra() 
  	{
  		if (! $this->call->precioCompra)
  		{
  			return 0;
  		}

  		if (! $this->put->precioVenta)
  		{
  			return 0;
  		}

		return $this->call->strike - $this->put->precioVenta + $this->call->precioCompra;
	}

	private function precioVenta() 
  	{
  		if (! $this->call->precioVenta)
  		{
  			return 0;
  		}

  		if (! $this->put->precioCompra)
  		{
  			return 0;
  		}

		return $this->call->strike + $this->call->precioVenta - $this->put->precioCompra;
	}
}
