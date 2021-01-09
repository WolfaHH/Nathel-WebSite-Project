<?php

namespace Nathel;

Abstract class Controller
{

    protected static function updateSession()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = new User($_SESSION['user']['osu_id']);
        }
    }

    protected static function storeURI(){
        $_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI'];

    }

    public static function error()
    {
        require('../view/template/404.php');
    }

}


