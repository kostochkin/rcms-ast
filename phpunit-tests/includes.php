<?php

spl_autoload_register(function ($name) {
	$sp = explode('\\', $name);
	if (strtolower($sp[0]) === "rcms") {
		return require_once ($sp[count($sp) - 1] . ".php");
	}
	return true;
});

