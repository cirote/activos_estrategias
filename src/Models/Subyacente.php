<?php

namespace Cirote\Estrategias\Models;

use Cirote\Estrategias\Models\Opcion;
use Cirote\Estrategias\Models\Call;
use Cirote\Estrategias\Models\Put;

class Subyacente
{
	use HasAttributes, HasPrecios, HasSimbolo;

	private $opciones = [];


	public static function all()
	{
		return resolve(Contenedor::class)->getDatos()['Activos por ticker'];
	}

	public function __construct($attributes = [])
	{
		$this->setAttributes($attributes);
	}

	public function opciones()
	{
		return resolve(Contenedor::class)->getDatos()['Opciones por sigla'][$this->attributes['tickerOpcion']];

		return $this->opciones;
	}

	public function vencimientos()
	{
		$vencimientos = [];

		$datos = resolve(Contenedor::class)->getDatos()['Opciones por vencimiento'][$this->attributes['tickerOpcion']];

		foreach ($datos as $key => $value) 
		{
			$vencimientos[] = substr($key, 4, 2) . '-' . substr($key, 0, 4);
		}

		return $vencimientos;
	}
}