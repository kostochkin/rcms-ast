<?php

namespace rCMS\Compiler\MAst\Base;


class MArrayAccessor implements MAst {
	private $array;
	private $index;

	public function __construct(MAst $array, MAst $index) {
		$this->array = $array;
		$this->index = $index;
	}
	
	public function to_string() : string {
		$array = $this->array->to_string();
		$index = $this->index->to_string();
		return "{$array}[{$index}]";
	}
}

