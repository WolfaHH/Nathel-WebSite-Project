<?php


namespace Nathel;


Abstract class View
{
    public static function header()
    {

        include '../view/elements/header.php';
        echo 'flag';
    }

    public static function footer()
    {
        include '../view/elements/footer.php';
    }

}