<?php


namespace Nathel;


class CollectionView extends View
{

    public static function show(Collection $collection)
    {
        /*
        if (isset($_SESSION['user'])){
            $is_follow = $_SESSION['user']->getUserFollow($collection);
        }*/

        $Nb_mappools = 0;
        foreach($collection->getCollectionMappools() as $key):
            $Nb_mappools += 1;
        endforeach;
        $Nb_maps = 0;

        foreach($collection->getCollectionMappools() as $key => $value):

            $tmp = new Mappool($value['id']);

            $Nb_maps += $tmp->getNbMaps()['COUNT(*)'];
            endforeach;

        $tags = $collection->getCollectionTags();

        /*$contributors = $collection->getCollectionContributors();*/
        $contributors = "Thrace12, NATH, Farrell-Shey";

        require '../view/elements/collection/show.php';
    }

    public static function showV2(Collection $collection)
    {
        /*
        if (isset($_SESSION['user'])){
            $is_follow = $_SESSION['user']->getUserFollow($collection);
        }*/
        $Nb_mappools = 0;
        foreach($collection->getCollectionMappools() as $key):
            $Nb_mappools += 1;
        endforeach;

        $tags = $collection->getCollectionTags();

        //$contributors = $collection->getCollectionContributors();
        $contributors = "Thrace12, NATH, Farrell-Shey";

        require '../view/elements/collection/showV2.php';
    }

    public static function sectionV2($collections)
    {

        require '../view/elements/collection/sectionV2.php';
    }


}