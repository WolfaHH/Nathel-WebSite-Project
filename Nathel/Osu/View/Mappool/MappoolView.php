<?php


/******************** NameSpace *********************/
namespace Nathel\Osu\View\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;

Abstract class MappoolView extends View\View
{
    // USED ON HOME AND USER PAGES
    public static function show(Data\Mappool $mappool)
    {
        if (isset($_SESSION['user'])){
            $is_follow = $_SESSION['user']->getUserFollow($mappool);
        }

        $mappool_maps = $mappool->getMaps();

        $collection = new Data\Collection($mappool->collection_id);
        $tags = $collection->getCollectionTags();

        $submitter = new Data\User($mappool->submitter);

        require '../Nathel/Osu/View/Mappool/elements/mappool/show.php';
    }

    public static function section(array $mappools, string $sectionName)
    {

        require '../Nathel/Osu/View/Mappool/elements/mappool/section.php';
    }

    // USED ON COLLECTION PAGES

    public static function showV2(Data\Mappool $mappool)
    {
        if (isset($_SESSION)){
            $is_follow = $_SESSION['user']->getUserFollow($mappool);
        }

        $mappool_maps = $mappool->getMaps();

        require '../Nathel/Osu/View/Mappool/elements/mappool/showV2.php';
    }

    public static function sectionV2(array $mappools)
    {

        require '../Nathel/Osu/View/Mappool/elements/mappool/sectionV2.php';
    }

}