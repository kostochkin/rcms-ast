<?php

namespace rCMS\Compiler\MAst\Base;


class MSelfAccessor extends MStaticAccessor {
	public function __construct(MAst $prop) {
		parent::__construct(new MSelf(), $prop);
	}
}

