<?php

namespace rCMS\Compiler\MAst\Base;


class MHygienicId extends MId {
	public function __construct(string $name) {
		parent::__construct("h_" . $name);
	}
}

