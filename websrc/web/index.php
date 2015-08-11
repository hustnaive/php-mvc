<?php
error_reporting(E_ALL);
use core\Route;

//应用根目录
define('APP_ROOT', dirname(__DIR__));

//框架代码根目录
define('CORE_ROOT', APP_ROOT.DIRECTORY_SEPARATOR.'core');

//web跟目录
define('WEB_ROOT', APP_ROOT.DIRECTORY_SEPARATOR.'web');

require dirname(__DIR__).'/core/Autoloader.php';

//获取路由
$route = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:'/';

try {
  Route::run($route,$_REQUEST);
}
catch(Exception $e) {
  throw $e;
}
