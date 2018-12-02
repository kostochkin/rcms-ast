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
	
	public function test_MNum() : void  {
		$mvar = new MNum(1);
		$this->assertEquals(
			"1",
			$mvar->to_string());
  }
	
	public function test_MNull() : void  {
		$mvar = new MNull();
		$this->assertEquals(
			"null",
			$mvar->to_string());
  }

	public function test_MParent() : void  {
		$mvar = new MParent();
		$this->assertEquals(
			"parent",
			$mvar->to_string());
  }

	public function test_MSelf() : void  {
		$mvar = new MSelf();
		$this->assertEquals(
			"self",
			$mvar->to_string());
  }

	public function test_MThis() : void  {
		$mvar = new MThis();
		$this->assertEquals(
			"\$this",
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

