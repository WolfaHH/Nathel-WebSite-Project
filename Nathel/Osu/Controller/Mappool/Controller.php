<?php

/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api as Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;

Abstract class Controller
{

    protected static function updateSession()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = new Data\User($_SESSION['user']->osu_id);
        }
    }

    public static function storeURI(){
        $_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI'];

    }

    public static function error()
    {
        require('../Nathel/Osu/View/Mappool/template/404.php');
    }

}



