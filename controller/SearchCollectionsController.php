<?php


namespace Nathel;


class SearchCollectionsController extends Controller
{
    public static function showSearchCollections()
    {

        View::header();
        include '../view/elements/searchbar/bar.php';
        include '../view/elements/searchbar/parameters.php';

        $collections = self::loadCollections();
        include '../view/elements/searchbar/results.php';
        view::footer();
    }

    public static function loadCollections()
    {
        if (isset($_GET['search']) == False) {
            $collections = Collection::getMostPopular();

        }
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