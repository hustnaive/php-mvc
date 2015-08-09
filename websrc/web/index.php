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

Route::add('/',function($params) {
    print_r($params);
});

Route::run('index',['a'=>1]);
Route::run('index/',['a'=>1]);
Route::run('index/index',['a'=>1]);
Route::run('index/index/',['a'=>1]);
Route::run('index/index/index',['a'=>1]);

Route::run('/',['a'=>1]);
