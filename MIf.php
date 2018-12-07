<?php

namespace rCMS\Compiler\MAst\Base;


class MIf implements MAst {
	private $predicate;
	private $then;
	private $else;

	public function __construct(MAst $predicate, MAst $then, MAst $else=null) {
		$this->predicate = $predicate;
		$this->then = $then;
		$this->else = $else;
	}

	public function to_string() : string {
		$predicate = $this->predicate->to_string();
		$then = $this->then->to_string();
		if (is_null($this->else)) {
			$else = "";
		} else {
			$else = " else " . $this->else->to_string();
		}
		return "if ({$predicate}) {$then}{$else}";
	}
}

