<?php

namespace rCMS\Compiler\MAst\Base;


class MCase implements MAst {
	private $pattern;
	private $actions;

	public function __construct(MAst $pattern, MAst $actions) {
		$this->pattern = $pattern;
		$this->actions = $actions;
	}

	public function to_string() :string {
		$p = $this->pattern->to_string();
		$a = $this->actions->to_string();
		return "case {$p}: {$a}";
	}	
}

