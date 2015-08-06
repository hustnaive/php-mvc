<?php
namespace core;

/**
 * 所有的控制器必须继承自core\Controller,文件名和类名相同，以Controller结尾。
 * 
 * 然后在里面实现自定义处理方法。
 * 
 * 默认处理方法为index方法，默认控制器为web\ctrls\IndexController;
 * 
 * 注意请勿随意覆盖Controller::_run方法，否则会导致你的控制器无法正常运行
 * 
 * @author fangl
 *
 */
class Controller {
    
    public function _run($action,$params=[]) {
        if(method_exists($this, $action)) {
            return call_user_func_array([$this,$action], [$params]);
        }
        else throw new \Exception('controller '.get_class($this).' does not has method '.$action);
    }
    
}