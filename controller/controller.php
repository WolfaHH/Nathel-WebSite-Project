<?php

namespace Nathel;
require 'Autoloader.php';

require 'Autoloader.php';

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
        require('../view/template/404.php');
    }
}


