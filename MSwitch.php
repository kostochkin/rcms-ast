<?php

namespace rCMS\Compiler\MAst\Base;


class MSwitch implements MAst {
	private $var;
	private $body;

	public function __construct(MAst $var, MAst $body) {
		$this->var = $var;
		$this->body = $body;
	}

	public function to_string() : string {
		$var = $this->var->to_string();
		$body = $this->body->to_string();
		return "switch ({$var}) {$body}";
	}
}
