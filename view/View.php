<?php


namespace Nathel;


Abstract class View
{
    public static function header()
    {

        include '../view/elements/header.php';
    }

    public static function footer()
    {
        include '../view/elements/footer.php';
    }

}