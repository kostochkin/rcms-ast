<?php

namespace rCMS\Compiler\MAst\Base;


class MBody extends MBodySequence {
	public function to_string() : string {
		$seq = parent::to_string();
		return " {\n{$seq}\n}";
	}
}

