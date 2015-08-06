<?php
error_reporting(E_ALL);
use core\Route;

require dirname(__DIR__).'/core/Autoloader.php';

Route::run('index',['a'=>1]);
Route::run('index/',['a'=>1]);
Route::run('index/index',['a'=>1]);
Route::run('index/index/index',['a'=>1]);

