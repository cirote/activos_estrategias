<?php

namespace Cirote\Estrategias\Models;

class Lanzamiento
{
	private $call;

	public $TNA;

	public function __construct(Call $call)
	{
		$this->call = $call;

		$this->TNA = $this->tasa() / $this->call->dias * 365;
	}

	public function __get($property)
	{
		return $this->$property();
	}

	private function subyacente()
	{
		return $this->call->subyacente;
	}

	private function call()
	{
		return $this->call;
	}

  	public function valorImplicito() 
  	{
		return max($this->subyacente->precioVenta() - $this->call->strike, 0);
	}

	private function valorExplicito() 
	{
		return max($this->call->precioCompra - $this->valorImplicito, 0);
	}

	private function tasa() 
	{
		return $this->valorExplicito / $this->call->strike;
	}
}
