<?php

namespace rCMS\Compiler\MAst\Base;


class MId implements MAst {
	public $name;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function to_string() : string {
		return $this->name;
	}
}

