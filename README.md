# rCMS\Compiler\MAst\Base

This module implements PHP abstract syntax tree in PHP.

## Usage example

    namespace rCMS\Compiler\MAst\Base;
    $assign = new MBodySequence(new MAssign(new MVar(new MId("foo")), new MString("bar")));
    echo $assign->to_string(); #> $foo = "bar";
    eval($assign->to_string());
    var_dump($foo);`#> string(3) "bar"
