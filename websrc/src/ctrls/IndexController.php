<?php
namespace web\ctrls;

use core\Controller;

class IndexController extends Controller {

    public function index($params) {
        echo $this->_render('index',$params);
    }

    public function b($params) {
        print_r($params);
    }
}
