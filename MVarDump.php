<?php

namespace rCMS\Compiler\MAst\Base;


class MVarDump extends MApplication {
	public function __construct($arg) {
		parent::__construct(new MId("var_dump"), [$arg]);
	}
}

