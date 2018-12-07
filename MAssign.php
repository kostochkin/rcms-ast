<?php

namespace rCMS\Compiler\MAst\Base;


class MAssign implements MAst {
	private $var;
	private $node;

	public function __construct(MAst $var, MAst $node) {
		$this->var = $var;
		$this->node = $node;
	}

	public function to_string() : string {
		$v = $this->var->to_string();
		$n = $this->node->to_string();
		return "{$v} = {$n}";
	}
}

