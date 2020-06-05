<?php

namespace Cirote\Estrategias\Models;

use Carbon\Carbon;
use Cirote\Estrategias\Models\Subyacente;

class Opcion
{
	private $subyacente;

	private $attributes = [];

	public function __construct(Subyacente $subyacente, $attributes = [])
	{
		$this->subyacente = $subyacente;

		$this->attributes = $attributes;
	}

	public function __get($property)
	{
		return $this->$property();
	}

	private function dias() 
  	{
		return Carbon::now()->diffInDays($this->attributes['fechaVencimiento']);
	}

	private function strike() 
  	{
		return $this->attributes['precioEjercicio'];
	}

	private function simbolo() 
  	{
		return $this->attributes['simbolo'];
	}

	private function subyacente() 
  	{
		return $this->subyacente;
	}

	private function precioCompra() 
  	{
		return $this->attributes['puntas']['precioCompra'];
	}
}