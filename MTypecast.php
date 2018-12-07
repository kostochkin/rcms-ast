<?php

namespace rCMS\Compiler\MAst\Base;


class MTypecast implements MAst {
	private $type;
	private $ast;

	public function __construct(string $type, MAst $ast) {
		$this->type = $type;
		$this->ast = $ast;
	}

	public function to_string() : string {
		return "({$this->type})" . $this->ast->to_string();
	}
}

