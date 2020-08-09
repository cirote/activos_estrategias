<?php

namespace Cirote\Estrategias\Models;

use Cirote\Activos\Models\Bs;

trait HasVolatilidad
{
	use Bs;

	public function getPrecioBS($s0, $x, $r, $d, $t) 
	{
		$d1 = $this->distribucionNormal($this->d1($s0, $x, $r, $d, $t));

		$d2 = $this->distribucionNormal($this->d2($s0, $x, $r, $d, $t));

		$xt = $x * exp(-$r * $t);

		return ($s0 * $d1) - ($xt * $d2);
	}

	public function volatilidadImplicita($prima) 
	{
		return $this->volatilidad(
			$this->subyacente->precioUltimo, 
			$this->strike,
			$this->tasaLibreDeRiesgo, 
			$prima, 
			$this->dias / 365
		) * 100;
	}
}
