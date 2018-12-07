<?php

namespace rCMS\Compiler\MAst\Base;


class MApplication implements MAst {
	private $fn;
	private $args;

	public function __construct(MASt $fn, array $args=[]) {
		$this->fn = $fn;
		$this->args = $args;
	}

	public function to_string() : string {
		$fn = $this->fn->to_string();
		$f = function ($x) { return $x->to_string(); };
		return "{$fn}(" . join(", ", array_map($f, $this->args)) . ")";
	}
}

