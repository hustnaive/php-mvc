<?php
namespace web\ctrls\index;

use core\Controller;

class IndexController extends Controller {

    public function index($params) {
        echo $this->_render($params);
    }
}
