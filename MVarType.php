<?php

namespace rCMS\Compiler\MAst\Base;


class MVarType extends MSpecDeclaration {
	private $type;

	public function __construct(string $type, MAst $var) {
		$this->type = $type;
		parent::__construct($var);
	}

	protected function declaration() : string {
		return $this->type;
	}
}

