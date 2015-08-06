<?php
namespace core;

class Controller {
    
    public function _run($action,$params=[]) {
        if(method_exists($this, $action)) {
            return call_user_func_array([$this,$action], [$params]);
        }
        else throw new \Exception('controller '.get_class($this).' does not has method '.$action);
    }
    
}