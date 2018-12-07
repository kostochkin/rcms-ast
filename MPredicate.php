<?php

namespace rCMS\Compiler\MAst\Base;


abstract class MPredicate implements MAst {
	public function to_string() : string {
		return "(" . $this->to_string() . ")";
	}
}

