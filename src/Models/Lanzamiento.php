<?php

namespace Cirote\Estrategias\Models;

use Cirote\Estrategias\Actions\EstrategiaLanzamientoCubiertoAction as ObtenerLanzamientosCubiertos;

class Lanzamiento
{
	use HasAttributes;

	private $call;

	public $TNA;

	public static function all()
	{
		$obtenerLanzamientosCubiertos = resolve(ObtenerLanzamientosCubiertos::class);

        return collect($obtenerLanzamientosCubiertos->execute())
            ->sortByDesc('TNA');
	}

	public function __construct(Call $call)
	{
		$this->call = $call;

		$this->TNA = $this->tasa() / $this->call->dias * 365;
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
