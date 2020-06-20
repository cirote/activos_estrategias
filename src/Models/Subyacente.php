<?php

namespace Cirote\Estrategias\Models;

use Cirote\Estrategias\Models\Opcion;
use Cirote\Estrategias\Models\Call;
use Cirote\Estrategias\Models\Put;

class Subyacente
{
	use HasAttributes, HasSimbolo;

	private $opciones = [];

	public function __construct($attributes = [])
	{
		$this->setAttributes($attributes);
	}

	public function opciones()
	{
		return resolve(Contenedor::class)->getDatos()['Opciones por sigla'][$this->attributes['tickerOpcion']];

		return $this->opciones;
	}

	public function precioVenta() 
  	{
  		if (isset($this->attributes['puntas']))
		{
			return $this->attributes['puntas']['precioVenta'];
		}

		return 0;
	}
}