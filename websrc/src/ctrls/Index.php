<?php
namespace web\ctrls;

use core\Controller;

class Index extends Controller {
    
    public function index($param) {
        echo 'index';
    }
    
    public function b($param) {
        print_r($param);
    }
}