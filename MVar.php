<?php

namespace rCMS\Compiler\MAst\Base;


class MVar implements MAst {
	public $name;

	public function __construct(MAst $name) {
		$this->name = $name;
	}

	public function to_string() : string {
		return "\$" . $this->name->to_string();
	}
}
