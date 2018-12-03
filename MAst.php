<?php

namespace rCMS\MAst;


interface MAst {
	public function to_string() : string;
}

class MClass implements MAst {
	private $vars = [];
	private $functions = [];
	private $name;


	public function __construct(MAst $name) {
		$this->name = $name;
	}

	public function add_var(MAst $var) {
		$this->vars[] = $var;
	}

	public function add_function(MAst $fn) {
		$this->functions[] = $fn;
	}

	public function to_string() : string {
		$name = $this->name->to_string();
		$vs = $this->render_vars();
		$fs = $this->render_functions();
		return "class {$name} {\n\n{$vs}\n\n{$fs}\n }";
	}

	private function render_vars() {
		$f = function ($x) { return $x->to_string() . ";"; };
		return join("\n", array_map($f, $this->vars));
	}
	
	private function render_functions() {
		$f = function ($x) { return $x->to_string(); };
		return join("\n\n", array_map($f, $this->functions));
	}
}

class MVar implements MAst {
	public $name;

	public function __construct(MAst $name) {
		$this->name = $name;
	}

	public function to_string() : string {
		return "\$" . $this->name->to_string();
	}
}

class MFunction implements MAst {
	public $name;
	private $variables;
	private $body;

	public function __construct(MAst $name, array $variables, MAst $body) {
		$this->name = $name;
		$this->variables = $variables;
		$this->body = $body;
	}
	
	public function to_string() : string {
		$name = $this->name->to_string();
		$f = function ($x) { return $x->to_string(); };
		$vars = join(", ", array_map($f, $this->variables));
		return "function {$name}({$vars})" . $this->body->to_string();
	}

}

class MArray implements MAst {
	private $items;

	public function __construct(array $items) {
		$this->items = $items;
	}

	public function to_string() : string {
		$list = join(", ", array_map(function ($x) { return $x->to_string(); }, $this->items));
		return "[{$list}]";
	}
}

abstract class MSequence implements MAst {
	private $seq;

	public function __construct(array $seq) {
		$this->seq = $seq;
	}

	abstract protected function render_one(MAst $one) : string;

	public function to_string() : string {
		$seq = join("\n", array_map(array($this, "render_one"), $this->seq));
		return "{$seq}";
	}

}


class MDeclarationSequence extends MSequence {
	protected function render_one(MAst $one) : string {
		return $one->to_string() . "\n";
	}
}

class MBodySequence extends MSequence {
	protected function render_one(MAst $one) : string {
		return $one->to_string() . ";";
	}
}

class MBody extends MBodySequence {
	public function to_string() : string {
		$seq = parent::to_string();
		return " {\n{$seq}\n}";
	}
}

class MId implements MAst {
	public $name;

	public function __construct(string $name) {
		$this->name = $name;
	}

	public function to_string() : string {
		return $this->name;
	}
}

class MObjectAccessor implements MAst {
	private $obj;
	private $prop;

	public function __construct(MAst $obj, MAst $prop) {
		$this->obj = $obj;
		$this->prop = $prop;
	}

	public function to_string() : string {
		$obj = $this->obj->to_string();
		$prop = $this->prop->to_string();
		return "{$obj}->{$prop}";
	}
}

class MStaticAccessor implements MAst {
	private $cls;
	private $prop;

	public function __construct(MAst $cls, MAst $prop) {
		$this->cls = $cls;
		$this->prop = $prop;
	}

	public function to_string() : string {
		$cls = $this->cls->to_string();
		$prop = $this->prop->to_string();
		return "{$cls}::{$prop}";
	}
}

class MThisAccessor extends MObjectAccessor {
	public function __construct(MAst $prop) {
		parent::__construct(new MThis(), $prop);
	}
}

class MSelfAccessor extends MStaticAccessor {
	public function __construct(MAst $prop) {
		parent::__construct(new MSelf(), $prop);
	}
}

class MThis extends MVar {
	public function __construct() {
		parent::__construct(new MId("this"));
	}
}

class MSelf extends MId {
	public function __construct() {
		parent::__construct("self");
	}
}

class MParent extends MId {
	public function __construct() {
		parent::__construct("parent");
	}
}

class MAssign implements MAst {
	private $var;
	private $node;

	public function __construct(MAst $var, MAst $node) {
		$this->var = $var;
		$this->node = $node;
	}

	public function to_string() : string {
		$v = $this->var->to_string();
		$n = $this->node->to_string();
		return "{$v} = {$n}";
	}
}

class MReturn implements MAst {
	private $node;

	public function __construct(MAst $node) {
		$this->node = $node;
	}

	public function to_string() : string {
		return "return " . $this->node->to_string();
	}
}

class MApplication implements MAst {
	private $fn;
	private $args;

	public function __construct(MASt $fn, array $args=[]) {
		$this->fn = $fn;
		$this->args = $args;
	}

	public function to_string() : string {
		$fn = $this->fn->to_string();
		$f = function ($x) { return $x->to_string(); };
		return "{$fn}(" . join(", ", array_map($f, $this->args)) . ")";
	}
}

class MNull extends MId {
	public function __construct() {
		parent::__construct("null");
	}
}

class MIf implements MAst {
	private $predicate;
	private $then;
	private $else;

	public function __construct(MAst $predicate, MAst $then, MAst $else=null) {
		$this->predicate = $predicate;
		$this->then = $then;
		$this->else = $else;
	}

	public function to_string() : string {
		$predicate = $this->predicate->to_string();
		$then = $this->then->to_string();
		if (is_null($this->else)) {
			$else = "";
		} else {
			$else = " else " . $this->else->to_string();
		}
		return "if {$predicate} {$then}{$else}";
	}
}

abstract class MPredicate implements MAst {
	public function to_string() : string {
		return "(" . $this->to_string() . ")";
	}
}

class MIsNullP extends MPredicate {
	private $node;
	public function __construct(MAst $node) {
		$this->node = new MApplication(new MId("is_null"), [$node]);
	}
	
	public function to_string() : string {
		return $this->node->to_string();
	}
}

class MSwitch implements MAst {
	private $var;
	private $body;

	public function __construct(MAst $var, MAst $body) {
		$this->var = $var;
		$this->body = $body;
	}

	public function to_string() : string {
		$var = $this->var->to_string();
		$body = $this->body->to_string();
		return "switch ({$var}) {$body}";
	}
}

class MCase implements MAst {
	private $pattern;
	private $actions;

	public function __construct(MAst $pattern, MAst $actions) {
		$this->pattern = $pattern;
		$this->actions = $actions;
	}

	public function to_string() :string {
		$p = $this->pattern->to_string();
		$a = $this->actions->to_string();
		return "case {$p}: {$a}";
	}	
}

abstract class MConstantValue implements MAst {
	protected $value;

	public function __construct($value) {
		$this->value = $value;
	}
}

class MString extends MConstantValue {
	public function to_string() : string {
		return "\"{$this->value}\"";
	}
}

class MNum extends MConstantValue {
	public function to_string() : string {
		return "{$this->value}";
	}
}

class MNew extends MApplication {
	public function to_string() : string {
		$app = parent::to_string();
		return "new {$app}";
	}
}

abstract class MSpecDeclaration implements MAst {
	protected $something;

	public function __construct(MAst $something) {
		$this->something = $something;
	}

	public function to_string() : string {
		$p = $this->something->to_string();
		$t = $this->declaration();
		return "{$t} {$p}";
	}
	
	abstract protected function declaration() : string;
}

class Mprivate extends MSpecDeclaration {
	protected function declaration() : string {
		return "private";
	}
}


class Mpublic extends MSpecDeclaration {
	protected function declaration() : string {
		return "public";
	}
}

class Mstatic extends MSpecDeclaration {
	protected function declaration() : string {
		return "static";
	}
}

class MVarType extends MSpecDeclaration {
	private $type;

	public function __construct(string $type, MAst $var) {
		$this->type = $type;
		parent::__construct($var);
	}

	protected function declaration() : string {
		return $this->type;
	}
}

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
