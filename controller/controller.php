<?php

namespace Nathel;

class Controller
{

    protected static function updateSession()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['user']->getuser($_SESSION['user']->id);
        }
    }

    public function home()
    {
        require('home.php');
    }

    public function mappools()
    {
        require('mappools.php');
    }

    public function error()
    {
        require('../view/template/404.php');
    }

}


