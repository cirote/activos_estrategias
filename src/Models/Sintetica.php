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
		return $this->call
			? $this->call->subyacente
			: $this->put->subyacente;
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
  		if ((! $this->call->precioCompra) OR (! $this->put->precioVenta))
  		{
  			return null;
  		}

		return $this->call->strike - $this->put->precioVenta + $this->call->precioCompra;
	}

	private function precioVenta() 
  	{
  		if ((! $this->call->precioVenta) OR (! $this->put->precioCompra))
  		{
  			return null;
  		}

		return $this->call->strike + $this->call->precioVenta - $this->put->precioCompra;
	}

	private function precioRealCompra() 
  	{
  		if ((! $this->call->precioCompra) OR (! $this->put->precioVenta))
  		{
  			return null;
  		}

		return $this->call->precioCompra - $this->put->precioVenta;
	}

	private function precioRealVenta() 
  	{
  		if ((! $this->call->precioVenta) OR (! $this->put->precioCompra))
  		{
  			return null;
  		}

		return $this->call->precioVenta - $this->put->precioCompra;
	}
}
