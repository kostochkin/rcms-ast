<?php

namespace rCMS\Compiler\MAst\Base;


class MNum extends MConstantValue {
	public function to_string() : string {
		return "{$this->value}";
	}
}

