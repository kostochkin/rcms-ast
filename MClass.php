<?php

namespace rCMS\Compiler\MAst\Base;


class MClass implements MAst {
	private $vars = [];
	private $functions = [];
	private $name;


	public function __construct(MAst $name) {
		$this->name = $name;
	}

	final public function add_var(MAst $var) {
		$this->vars[] = $var;
	}

	final public function add_function(MAst $fn) {
		$this->functions[] = $fn;
	}

	final public function to_string() : string {
		$name = $this->name->to_string();
		$vs = $this->render_vars();
		$fs = $this->render_functions();
		return "class {$name} {\n\n{$vs}\n\n{$fs}\n }";
	}

	final private function render_vars() {
		$f = function ($x) { return $x->to_string() . ";"; };
		return join("\n", array_map($f, $this->vars));
	}
	
	final private function render_functions() {
		$f = function ($x) { return $x->to_string(); };
		return join("\n\n", array_map($f, $this->functions));
	}
}
