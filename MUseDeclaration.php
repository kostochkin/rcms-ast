<?php

namespace rCMS\Compiler\MAst\Base;


class MUseDeclaration extends MStatement {
	protected function statement() : string {
		return "use";
	}
}
