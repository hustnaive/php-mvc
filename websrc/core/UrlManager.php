<?php

namespace core;

class UrlManager {
	
	public function handleRequest() {
		$ctlname = '\src'.$_SERVER['PATH_INFO'];
		$ctlname = str_replace('/','\\',$ctlname);
		$ctl = new $ctlname;
		$ctl->run();
	}
}