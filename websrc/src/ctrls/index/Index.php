<?php
namespace web\ctrls\index;

use core\Controller;

class Index extends Controller {
    
    public function index() {
        echo get_class($this);
    }
}