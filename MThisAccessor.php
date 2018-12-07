<?php

namespace rCMS\Compiler\MAst\Base;


class MThisAccessor extends MObjectAccessor {
	public function __construct(MAst $prop) {
		parent::__construct(new MThis(), $prop);
	}
}

