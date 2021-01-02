<?php


namespace Nathel;


class CollectionView extends View
{

    public static function show(Collection $collection)
    {
        if (isset($_SESSION)){
            $is_follow = $_SESSION['user']->getUserFollow($mappool);
        }

        $Nb_maps = 0;
        foreach($collection->getCollectionMappools() as $key => $value):
            $Nb_maps += $key->getNbMaps();
            endforeach;

        $tags = $collection->getCollectionTags();

        $contributors = getCollectionContributors();

        require '../view/elements/collection/show.php';
    }


}