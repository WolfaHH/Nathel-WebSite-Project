<?php


/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;


class ManagePoolsController extends Controller
{
    protected function setUser()
    {
        /* Ce qu'il faut mettre
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            $this->error();
            ();
        }*/
        // Ce qui marche pour des tests ;
        return new Data\User(9543633);
    }

    public function showManagePools()
    {
        Control\Controller::storeURI();
        // traitement de donnée
        self::updateSession();

        $user = $this->setUser();
        // appel visuel de la page
        View\View::header();

        require '../Nathel/Osu/View/Mappool/elements/mappool/button_createNewPool.php';

        $collections = $user->getUserCollections();


        View\CollectionView::sectionV2($collections);

        View\View::footer();

    }

    public function show_edit(){
        Control\Controller::storeURI();
        View\View::header();


        preg_match_all('!\d+!', $_GET['url'], $collection_id);
        $collection = new Data\Collection($collection_id[0][0]);
        $collection->name;
        $Tags = Data\Collection::getTAGS();
        $tags = $collection->getCollectionTags();
        $contributors = $collection->getContributorsAsUsers();
        include '../Nathel/Osu/View/Mappool/elements/create_collection/collection_change_info.php';

        $pools = $collection->getCollectionMappools();

        foreach($pools as $pool){

            include '../Nathel/Osu/View/Mappool/elements/create_collection/mappool_change_name.php';
            $poopool = new Data\Mappool($pool['id']);
            $maps = $poopool->GetMaps();
            $mods = ['NM','DT','HR','HD','EZ','FL','Others'];
            $position = 0;
            foreach ($maps as $mamap){
                $position = $position + 1;

                $map = new Data\Map($mamap['map_id']);
                include '../Nathel/Osu/View/Mappool/elements/create_collection/map.php';
            }

            include '../Nathel/Osu/View/Mappool/elements/create_collection/addmap.php';



        }


        include '../Nathel/Osu/View/Mappool/elements/create_collection/addnewpool.php';

        View\View::footer();
    }

    public function show_edited(){
        preg_match_all('!\d+!', $_GET['url'], $collection_id);
        $collection_id = $collection_id[0][0];
        //mise à jour des données contenues dans POST :

        if (array_key_exists('name', $_POST)) {
            $cocol = new Data\Collection($collection_id);
            $cocol->updateName($_POST['name']);
        }
        elseif (array_key_exists('description', $_POST)) {
            $cocol = new Data\Collection($collection_id);
            $cocol->updateDescription($_POST['description']);

        }
        elseif (array_key_exists('addtag', $_POST)) {
            $cocol = new Data\Collection($collection_id);
            $cocol->storeCollectionTag($_POST['addtag']);

        }
        elseif (array_key_exists('removetag', $_POST)) {
            $cocol = new Data\Collection($collection_id);
            $cocol->deleteCollectionTag($_POST['removetag']);
        }
        elseif (array_key_exists('addcontributor', $_POST)) { // AJouter sécurité si le gars est créator ou déja contributor

            $user = new Data\User(User::getUserbyName($_POST['addcontributor'])['osu_id']);
            $user->storeContributor($collection_id);
        }
        elseif (array_key_exists('removecontributor', $_POST)) { //Ajouter sécurité si le gars est creator ou déja contributor
            $user = new Data\User($_POST['removecontributor']);
            $user->deleteContributor($collection_id);
        }
        elseif (array_key_exists('changepoolname', $_POST)) {
            $poopool = new Data\Mappool($_GET['pool_id']);

            $poopool->UpdateName($_POST['changepoolname']);

        }
        elseif (array_key_exists('url', $_POST)) {
            // Check si l'url est dans 'map', en récupérant le map_id

            if (Data\Map::checkMapWithUrl($_POST['url']) === False){


                $last_occur = strripos($_POST['url'], "/");
                $id = substr($_POST['url'],$last_occur+1);


                $query = $_SESSION['OsuApi']->getBeatmapInfo($id);

                //Non => Check si est sur osu!
                    if (count($query) >3){

                        //Oui => On enregistre dans un nouveau tuple de 'map' la map avec des requetes API
                        $data = [
                            'beatmapset_id' => $query['beatmapset']['id'],
                            'creator'=> $query['beatmapset']['creator'],
                            'artist'=>$query['beatmapset']['artist'],
                            'name'=>$query['beatmapset']['title']
                        ];
                        $set_id = Data\Map::StoreMapset($data);
                        $data = [
                            'beatmapset_id' =>$set_id,
                            'bpm'=>$query['bpm'],
                            'ar'=>$query['ar'],
                            'cs'=>$query['cs'],
                            'drain'=>$query['drain'],
                            'accuracy'=>$query['accuracy'],
                            'hit_length'=>$query['hit_length'],
                            'mode_int'=>$query['mode_int'],
                            'url'=>$query['url'],
                            'difficulty'=>$query['version']
                        ];
                        $new = Data\Map::StoreMap($data);
                        // On remplace le map_id du tuple correspondant dans 'mappool-maps' avec la map_id récupérer

                        if (array_key_exists('map_id', $_GET)){
                            Data\Mappool::updateMapUrl($_GET['map_id'], $_GET['pool_id'], $new);
                        }else{
                            $data = [
                            'position' => $_GET['position'],
                            'user_id' => $_SESSION['user']->osu_id,
                            'mode' => $_POST['mode'],
                            'pool_id' => $_GET['pool_id'],
                            'map_id' => Data\Map::getMapWithUrl($_POST['url'])];
                            Data\Mappool::storeNewMappool_maps($data);

                        }


                    }

                    }else{

                // On remplace le map_id du tuple correspondant dans 'mappool-maps' avec la map_id récupérer
                if (array_key_exists('map_id', $_GET)){
                    $new = Data\Map::getMapWithUrl($_POST['url']);

                    Data\Mappool::updateMapUrl($_GET['map_id'], $_GET['pool_id'], $new);
                }else{
                        $data = [
                            'position' => $_GET['position'],
                            'user_id' => $_SESSION['user']->osu_id,
                            'mode' => $_POST['mode'],
                            'pool_id' => $_GET['pool_id'],
                            'map_id' => Data\Map::getMapWithUrl($_POST['url'])];
                        Data\Mappool::storeNewMappool_maps($data);



                }

            }

        }


        if (array_key_exists('mode', $_POST)) {
            // Remplacer le mode là ou les infos correspondent
            if (array_key_exists('map_id', $_GET)){
                $poopool = new Data\Mappool($_GET['pool_id']);
                $data = [
                    'map_id'=>$_GET['map_id'],
                    'mode'=> $_POST['mode']
                ];
                $poopool->UpdateMapMode($data);
            }

        }
        elseif (array_key_exists('newpoolcreated', $_POST)) {

            $data = [
                'col_id'=>$collection_id,
                'name'=> 'New pool',
                'user_id' => $_SESSION['user']->osu_id,
                'thumbnail' => './assets/img/default.png'
            ];
            Data\Mappool::storeNewPool($data);

        }

        $this->show_edit();

    }





}