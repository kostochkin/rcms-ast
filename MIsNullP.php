<?php

namespace rCMS\Compiler\MAst\Base;


class MIsNullP extends MPredicate {
	private $node;
	public function __construct(MAst $node) {
		$this->node = new MApplication(new MId("is_null"), [$node]);
	}
	
	public function to_string() : string {
		return $this->node->to_string();
	}
}

