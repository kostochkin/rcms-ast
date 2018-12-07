<?php

namespace rCMS\Compiler\MAst\Base;


class MNew extends MApplication {
	public function to_string() : string {
		$app = parent::to_string();
		return "new {$app}";
	}
}
