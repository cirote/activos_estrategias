<?php

namespace Cirote\Estrategias\Models;

use Carbon\Carbon;
use Cirote\Estrategias\Models\Subyacente;

class Opcion
{
	use HasAttributes, HasPrecios, HasSimbolo;

	private $subyacente;

	public function __construct(Subyacente $subyacente, $attributes = [])
	{
		$this->subyacente = $subyacente;

		$this->attributes = $attributes;
	}

	private function fechaVencimiento() 
  	{
		return $this->attributes['fechaVencimiento'];
	}

	private function dias() 
  	{
		return Carbon::now()->diffInDays($this->attributes['fechaVencimiento']);
	}

	private function strike() 
  	{
		return $this->attributes['precioEjercicio'] ?? 0;
	}

	private function strike_entero() 
  	{
		return (int) ($this->strike * 100);
	}

	private function subyacente(): Subyacente
  	{
		return $this->subyacente;
	}
}