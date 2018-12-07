<?php

namespace rCMS\Compiler\MAst\Base;


class MNull extends MId {
	public function __construct() {
		parent::__construct("null");
	}
}

