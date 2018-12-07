<?php

namespace rCMS\Compiler\MAst\Base;


class MStaticAccessor implements MAst {
	private $cls;
	private $prop;

	public function __construct(MAst $cls, MAst $prop) {
		$this->cls = $cls;
		$this->prop = $prop;
	}

	public function to_string() : string {
		$cls = $this->cls->to_string();
		$prop = $this->prop->to_string();
		return "{$cls}::{$prop}";
	}
}

