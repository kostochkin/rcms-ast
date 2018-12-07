<?php

namespace rCMS\Compiler\MAst\Base;


class MUHygienicId extends MId {
	static private $n = 0;

	public function __construct() {
		parent::__construct(sprintf("hu_%'.05x", self::$n));
		self::$n += 1;
	}
}
