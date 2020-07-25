<?php

namespace Cirote\Estrategias\Models;

class Put extends Opcion
{
	public function valorIntrinseco()
	{
		return max($this->strike - $this->subyacente->precioUltimo, 0);
	}

	public function valorExplicitoCompra()
	{
		return $this->precioCompra - $this->valorIntrinseco;
	}

	public function valorExplicitoVenta()
	{
		return $this->precioVenta - $this->valorIntrinseco;
	}

	public function valorExplicitoUltimo()
	{
		return $this->precioUltimo - $this->valorIntrinseco;
	}
}