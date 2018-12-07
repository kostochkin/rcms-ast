<?php

namespace rCMS\Compiler\MAst\Base;


abstract class MConstantValue implements MAst {
	protected $value;

	public function __construct($value) {
		$this->value = $value;
	}
}

