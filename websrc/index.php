<?php

error_reporting(E_ALL);

spl_autoload_register(function($clsname){
	$clspath = explode('\\',$clsname);
	if($clspath[0] === 'web') {
		$clspath[0] = 'src';
	}
	require_once implode(DIRECTORY_SEPARATOR,$clspath).'.php';
});

(new web\A())->run();

(new web\a\b())->run();