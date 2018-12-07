<?php

namespace rCMS\Compiler\MAst\Base;


class MBodySequence extends MSequence {
	protected function render_one(MAst $one) : string {
		return $one->to_string() . ";";
	}
}

