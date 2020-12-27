<?php


namespace Nathel;


class MappoolView extends View
{

    public static function show(Mappool $mappool)
    {
        require 'view/elements/mappool/show.php';
    }

    public static function update()
    {
        require 'view/elements/mappool/update.php';
    }

}