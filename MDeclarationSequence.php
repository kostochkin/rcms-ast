<?php

namespace rCMS\Compiler\MAst\Base;


class MDeclarationSequence extends MSequence {
	protected function render_one(MAst $one) : string {
		return $one->to_string() . "\n";
	}
}

