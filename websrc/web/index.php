<?php
error_reporting(E_ALL);
use core\Route;

require dirname(__DIR__).'/core/Autoloader.php';

Route::add('/index', function($params) {
    print_r($params);
    echo 'callable';
});

Route::run('index',['a']);
