<?php

namespace rCMS\Compiler\MAst\Base;


class MThis extends MVar {
	public function __construct() {
		parent::__construct(new MId("this"));
	}
}

