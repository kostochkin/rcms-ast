<?php

namespace rCMS\Compiler\MAst\Base;


abstract class MSequence implements MAst {
	private $seq;

	public function __construct(array $seq) {
		$this->seq = $seq;
	}

	abstract protected function render_one(MAst $one) : string;

	public function to_string() : string {
		$seq = join("\n", array_map(array($this, "render_one"), $this->seq));
		return "{$seq}";
	}
}

