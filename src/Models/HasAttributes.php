<?php

namespace Cirote\Estrategias\Models;

trait HasAttributes
{
	private $attributes = [];

	public function setAttributes($attributes = [])
	{
		$this->attributes = $attributes;
	}

	public function addAttributes($attributes = [])
	{
		$this->attributes = array_merge($this->attributes, $attributes);
	}

	public function __get($property)
	{
		return $this->$property();
	}
}
