<?php

namespace Cirote\Estrategias\Models;

class Call extends Opcion
{
	public function valorIntrinseco()
	{
		return max($this->subyacente->precioUltimo - $this->strike, 0);
	}

	public function valorExplicitoCompra()
	{
		return $this->precioCompra
			? $this->precioCompra - $this->valorIntrinseco
			: null;
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