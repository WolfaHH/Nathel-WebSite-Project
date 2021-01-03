<?php


namespace Nathel;


class MappoolView extends View
{
    // USED ON HOME AND USER PAGES
    public static function show(Mappool $mappool)
    {
        if (isset($_SESSION['user'])){
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

    // USED ON COLLECTION PAGES

    public static function showV2(Mappool $mappool)
    {
        if (isset($_SESSION)){
            $is_follow = $_SESSION['user']->getUserFollow($mappool);
        }

        $mappool_maps = $mappool->getMaps();

        require '../view/elements/mappool/showV2.php';
    }

    public static function sectionV2(array $mappools)
    {

        require '../view/elements/mappool/sectionV2.php';
    }

}