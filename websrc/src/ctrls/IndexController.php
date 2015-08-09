<?php
namespace web\ctrls;

use core\Controller;

class IndexController extends Controller {

    public function index($param) {
        echo get_class($this);
    }

    public function b($param) {
        print_r($param);
    }
}
