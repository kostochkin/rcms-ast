<?php

namespace rCMS\Compiler\MAst\Base;


class MFunction implements MAst {
	public $name;
	private $variables;
	private $body;

	public function __construct(MAst $name, array $variables, MAst $body) {
		$this->name = $name;
		$this->variables = $variables;
		$this->body = $body;
	}
	
	public function to_string() : string {
		$name = $this->name->to_string();
		$f = function ($x) { return $x->to_string(); };
		$vars = join(", ", array_map($f, $this->variables));
		return "function {$name}({$vars})" . $this->body->to_string();
	}
}

