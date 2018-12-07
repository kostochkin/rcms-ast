<?php

namespace rCMS\Compiler\MAst\Base;

abstract class MStatement implements MAst {
	private $decl;

	public function __construct(MAst $decl) {
		$this->decl = $decl;
	}

	public function to_string() : string {
		$s = $this->statement();
		$d = $this->decl->to_string();
		return "{$s} {$d};";
	}

	abstract protected function statement() : string;
	
}

