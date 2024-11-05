<?php

namespace App\core;


class controller{

    public function view($path,$parm = []){
        extract($parm);
        require_once(APP."views/".$path.".php");
    }
}