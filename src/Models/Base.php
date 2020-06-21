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

	public function __construct($base, ?Call $call, ?Put $put)
	{
		$this->base = $base;

		$this->call = $call;

		$this->put = $put;

		if ($call)
		{
			if ($put)
			{
				$this->sintetica = new Sintetica($call, $put);
			}			
		}
	}

	private function subyacente()
	{
		if ($this->call)
		{
			return $this->call->subyacente;
		}

		return $this->put->subyacente;
	}

	private function base()
	{
		return $this->base;
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
