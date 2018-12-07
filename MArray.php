<?php

namespace rCMS\Compiler\MAst\Base;


class MArray implements MAst {
	private $items;

	public function __construct(array $items) {
		$this->items = $items;
	}

	public function to_string() : string {
		$list = join(", ", array_map(function ($x) { return $x->to_string(); }, $this->items));
		return "[{$list}]";
	}
}

