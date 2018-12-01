<?php

namespace rCMS\MAst;

require "MAst.php";

use PHPUnit\Framework\TestCase;

final class ASTtest extends TestCase {
	public function test_MId() : void {
		$mid = new MId("foo");
		$this->assertEquals(
			"foo",
			$mid->to_string());
  }
	
	public function test_MVar() : void {
		$mvar = new MVar(new MId("foo"));
		$this->assertEquals(
			"\$foo",
			$mvar->to_string());
  }
	
	public function test_MString() : void {
		$mvar = new MString("foo");
		$this->assertEquals(
			"\"foo\"",
			$mvar->to_string());
  }
	
	public function test_MAssign() : void {
		$massign = new MAssign(new MVar(new MId("foo")), new MString("bar"));
		eval($massign->to_string() . ";");
		$this->assertEquals(
			"bar",
			$foo);
  }
}

