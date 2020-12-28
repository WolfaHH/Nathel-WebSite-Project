<?php


namespace Nathel;


class MappoolView extends View
{

    public static function show($display_pools, $displayname1, displayname2, $max)
    {
        require 'view/elements/mappool/show.php';
    }

}