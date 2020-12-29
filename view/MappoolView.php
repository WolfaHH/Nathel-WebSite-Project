<?php


namespace Nathel;


class MappoolView extends View
{

    public static function show(Mappool $mappool)
    {
        if (isset($_SESSION)){
            $is_follow = $_SESSION['user']->getUserFollow($mappool);
        }

        $mappool_maps = $mappool->getMaps();

        $collection = new \Nathel\Collection($mappool->collection_id);
        $tags = $collection->getCollectionTags();

        $submitter = new \Nathel\User($mappool->submitter);

        require '../view/elements/mappool/show.php';
    }

    public static function section(array $mappools, string $sectionName)
    {

        require '../view/elements/mappool/section.php';
    }

}