<?php

namespace Cirote\Estrategias\Models;

trait HasSimbolo
{
	public function simbolo() 
  	{
		return $this->attributes['simbolo'];
	}
}
