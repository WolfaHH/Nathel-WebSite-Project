<?php

//require('.php');

namespace Nathel;

class Controller extends Autoloader
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
        require('404.php');
    }
}


