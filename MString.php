<?php

namespace rCMS\Compiler\MAst\Base;


class MString extends MConstantValue {
	public function to_string() : string {
		return "\"{$this->value}\"";
	}
}
