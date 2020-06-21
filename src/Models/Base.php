<?php

namespace Cirote\Estrategias\Models;

use Cirote\Estrategias\Actions\CrearBasesAction as ObtenerBases;

class Base
{
	use HasAttributes;

	private $base;

	private $call;

	private $put;

	private $sintetica;

	public static function all()
	{
		$obtenerBases = resolve(ObtenerBases::class);

        return collect($obtenerBases->execute());
	}

	public function __construct($base, Call $call)
	{
		$this->base = $base;

		$this->call = $call;
	}

	private function subyacente()
	{
		return $this->call->subyacente;
	}

	private function base()
	{
		return $this->base;
	}

	private function call()
	{
		return $this->call;
	}
}
