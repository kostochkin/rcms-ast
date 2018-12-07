<?php

namespace rCMS\Compiler\MAst\Base;


class Mprivate extends MSpecDeclaration {
	protected function declaration() : string {
		return "private";
	}
}


