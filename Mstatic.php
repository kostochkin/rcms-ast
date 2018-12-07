<?php

namespace rCMS\Compiler\MAst\Base;


class Mstatic extends MSpecDeclaration {
	protected function declaration() : string {
		return "static";
	}
}

