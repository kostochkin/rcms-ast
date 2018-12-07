<?php

namespace rCMS\Compiler\MAst\Base;

class MNamespaceDeclaration extends MStatement {
	protected function statement() : string {
		return "namespace";
	}
}
