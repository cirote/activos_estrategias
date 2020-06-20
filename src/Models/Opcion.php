<?php

namespace Cirote\Estrategias\Models;

use Carbon\Carbon;
use Cirote\Estrategias\Models\Subyacente;

class Opcion
{
	use HasAttributes, HasSimbolo;

	private $subyacente;

	public function __construct(Subyacente $subyacente, $attributes = [])
	{
		$this->subyacente = $subyacente;

		$this->attributes = $attributes;
	}

	private function dias() 
  	{
		return Carbon::now()->diffInDays($this->attributes['fechaVencimiento']);
	}

	private function strike() 
  	{
		return $this->attributes['precioEjercicio'];
	}

	private function subyacente(): Subyacente
  	{
		return $this->subyacente;
	}

	private function precioCompra() 
  	{
		return $this->attributes['puntas']['precioCompra'];
	}
}