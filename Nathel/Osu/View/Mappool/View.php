<?php


namespace Nathel\Osu\View\Mappool;


Abstract class View
{
    public static function header()
    {

        include '../Nathel/Osu/View/Mappool/elements/header.php';
    }

    public static function footer()
    {
        include '../Nathel/Osu/View/Mappool/elements/footer.php';
    }

}