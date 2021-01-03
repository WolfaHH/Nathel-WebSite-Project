<?php


namespace Nathel;


class CollectionView extends View
{

    public static function show(Collection $collection)
    {
        if (isset($_SESSION)){
            $is_follow = $_SESSION['user']->getUserFollow($collection);
        }
        $Nb_maps = 0;
        foreach($collection->getCollectionMappools() as $key => $value):
            $tmp = new Mappool($key);
            $Nb_maps += $tmp->getNbMaps()[0]["COUNT(*)"];
            endforeach;

        $tags = $collection->getCollectionTags();

        $contributors = $collection->getCollectionContributors();

        require '../view/elements/collection/show.php';
    }


}