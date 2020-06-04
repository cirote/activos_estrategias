<?php

namespace Cirote\Estrategias\Models;

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
}