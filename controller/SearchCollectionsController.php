<?php


namespace Nathel;


class SearchCollectionsController extends Controller
{
    public static function showSearchCollections()
    {

        View::header();

        include '../view/elements/searchbar/bar.php';


        $collections = self::loadCollections();
        include '../view/elements/searchbar/results.php';

        view::footer();
    }

    public static function loadCollections()
    {

        # pour les filtres, optimiser à termes le get en URL
        #pour l'instant seul les critères catégorie et game mod sont appliqués


        if (isset($_GET['gm']) or isset($_GET['category[]'])){
            $filters = array();
            if (isset($_GET['gm'])){
                array_push($filters, $_GET['gm']);
            }
            if (isset($_GET['category'])){
                foreach($_GET['category'] as $value){
                    array_push($filters, $value);

                }
            }
        }


        #Cas ou la recherche est standard par popularité, avec donc possibilité de filtrer

        if ((array_key_exists('search',$_GET) === False) or (strlen($_GET['search'])===0)){
            if ((array_key_exists('gm',$_GET) === False) and (array_key_exists('category[]',$_GET) === False)) {
                $collections = Collection::getMostPopular();
                }
                else{
                    $collections = Collection::getMostPopular($filters);
                }
            }



        #cas ou la recherche est par mot clés, avec impossibilité d'utiliser les filtres pour le moment
        else{

            $mots = explode( " ", $_GET['search']);
            $tmp_collections = Collection::searchCollectionsWithName($mots);
            $collections = array();
            foreach ($tmp_collections as $collection){if ($collection['value'] == 5){array_push($collections, $collection);}}
            foreach ($tmp_collections as $collection){if ($collection['value'] == 4){array_push($collections, $collection);}}
            foreach ($tmp_collections as $collection){if ($collection['value'] == 3){array_push($collections, $collection);}}
            foreach ($tmp_collections as $collection){if ($collection['value'] == 2){array_push($collections, $collection);}}
            foreach ($tmp_collections as $collection){if ($collection['value'] == 1){array_push($collections, $collection);}}
        }
        return $collections;
    }



}