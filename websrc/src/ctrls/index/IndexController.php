<?php
namespace web\ctrls\index;

use core\Controller;

class IndexController extends Controller {
    
    public function index() {
        echo get_class($this);
    }
}