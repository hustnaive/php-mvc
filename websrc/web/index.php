<?php

error_reporting(E_ALL);

spl_autoload_register(function($clsname){
	$clspath = explode('\\',$clsname);
	if($clspath[0] === 'web') {
		$clspath[0] = 'src';
	}
	$a = 2;
	require dirname(__DIR__).DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,$clspath).'.php';
});


(new web\a\b())->run();

(new web\A())->run();
