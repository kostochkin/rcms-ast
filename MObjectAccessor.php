<?php

namespace rCMS\Compiler\MAst\Base;


class MObjectAccessor implements MAst {
	private $obj;
	private $prop;

	public function __construct(MAst $obj, MAst $prop) {
		$this->obj = $obj;
		$this->prop = $prop;
	}

	public function to_string() : string {
		$obj = $this->obj->to_string();
		$prop = $this->prop->to_string();
		return "{$obj}->{$prop}";
	}
}

