<?php

namespace rCMS\Compiler\MAst\Base;


abstract class MSpecDeclaration implements MAst {
	protected $something;

	public function __construct(MAst $something) {
		$this->something = $something;
	}

	public function to_string() : string {
		$p = $this->something->to_string();
		$t = $this->declaration();
		return "{$t} {$p}";
	}
	
	abstract protected function declaration() : string;
}
