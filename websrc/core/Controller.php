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

    public $title;
    public $layout = 'main';

    protected $name; //控制器路径名
    protected $action; //请求的方法名

    public function __construct() {
        $clsname = get_class($this);
        $this->name = strtolower(substr($clsname,strlen('web\\ctrls\\'),strlen($clsname)-strlen('Controller')-strlen('web\\ctrls\\')));
        $this->title = get_class($this);
    }

    public function _run($action,$params=[]) {
        if(method_exists($this, $action)) {
            $this->action = $action;
            return call_user_func_array([$this,$action], [$params]);
        }
        else throw new \Exception('控制器 '.get_class($this).' 没有方法 '.$action);
    }

    public function _render($view,$params=[]) {
      if(empty($this->layout)) {
          return $this->_renderContent($view,$params);
      }
      else {
          $layoutFile = APP_ROOT.'/src/views/layouts/'.$this->layout.'.php';
          $layoutFile = str_replace('\\','/',$layoutFile);
          if (!is_file($layoutFile)) {
              throw new \Exception("布局文件：{$layoutFile}不存在");
          }

          ob_start();
          ob_implicit_flush(false);
          extract(['content'=>$this->_renderContent($view,$params)], EXTR_OVERWRITE);
          require($layoutFile);
          return ob_get_clean();
      }
    }

    public function _renderContent($view,$params=[]) {
        //默认view的名字为action名
        if(is_array($view) && empty($params)) {
            $params = $view;
            $view = $this->action;
        }
        $viewFile = APP_ROOT.'/src/views/'.$this->name.'/'.$view.'.php';
        $viewFile = str_replace('\\','/',$viewFile);
        if(!is_file($viewFile)) {
            throw new \Exception("模板文件：{$viewFile}不存在");
        }
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        require($viewFile);
        return ob_get_clean();
    }

}
