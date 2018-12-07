<?php

namespace rCMS\Compiler\MAst\Base;


class MReturn implements MAst {
	private $node;

	public function __construct(MAst $node) {
		$this->node = $node;
	}


