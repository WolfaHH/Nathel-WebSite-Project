<?php


namespace Nathel;


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
        return new User(9543633);
    }

    public function showManagePools()
    {
        Controller::storeURI();
        // traitement de donnée
        self::updateSession();

        $user = $this->setUser();
        // appel visuel de la page
        View::header();

        require '../view/elements/mappool/button_createNewPool.php';

        $collections = $user->getUserCollections();

        CollectionView::sectionV2($collections);

        View::footer();

    }

    public function show_edit(){
        Controller::storeURI();
        View::header();


        preg_match_all('!\d+!', $_GET['url'], $collection_id);
        $collection = new Collection($collection_id[0][0]);
        $collection->name;
        $Tags = Collection::getTAGS();
        $tags = $collection->getCollectionTags();
        $contributors = $collection->getContributorsAsUsers();
        include '../view/elements/create_collection/collection_change_info.php';

        $pools = $collection->getCollectionMappools();

        foreach($pools as $pool){

            include '../view/elements/create_collection/mappool_change_name.php';
            $poopool = new Mappool($pool['id']);
            $maps = $poopool->GetMaps();
            $mods = ['NM','DT','HR','HD','EZ','FL','Others'];
            $position = 0;
            foreach ($maps as $mamap){
                $position = $position + 1;

                $map = new Map($mamap['map_id']);
                include '../view/elements/create_collection/map.php';
            }

            include '../view/elements/create_collection/addmap.php';



        }


        include '../view/elements/create_collection/addnewpool.php';

        View::footer();
    }

    public function show_edited(){
        preg_match_all('!\d+!', $_GET['url'], $collection_id);
        $collection_id = $collection_id[0][0];
        //mise à jour des données contenues dans POST :

        if (array_key_exists('name', $_POST)) {
            $cocol = new Collection($collection_id);
            $cocol->updateName($_POST['name']);
        }
        elseif (array_key_exists('description', $_POST)) {
            $cocol = new Collection($collection_id);
            $cocol->updateDescription($_POST['description']);

        }
        elseif (array_key_exists('addtag', $_POST)) {
            $cocol = new Collection($collection_id);
            $cocol->storeCollectionTag($_POST['addtag']);

        }
        elseif (array_key_exists('removetag', $_POST)) {
            $cocol = new Collection($collection_id);
            $cocol->deleteCollectionTag($_POST['removetag']);
        }
        elseif (array_key_exists('addcontributor', $_POST)) { // AJouter sécurité si le gars est créator ou déja contributor

            $user = new User(User::getUserbyName($_POST['addcontributor'])['osu_id']);
            $user->storeContributor($collection_id);
        }
        elseif (array_key_exists('removecontributor', $_POST)) { //Ajouter sécurité si le gars est creator ou déja contributor
            $user = new User($_POST['removecontributor']);
            $user->deleteContributor($collection_id);
        }
        elseif (array_key_exists('changepoolname', $_POST)) {
            $poopool = new Mappool($_GET['pool_id']);

            $poopool->UpdateName($_POST['changepoolname']);

        }
        elseif (array_key_exists('url', $_POST)) {
            // Check si l'url est dans 'map', en récupérant le map_id

            if (Map::checkMapWithUrl($_POST['url']) === False){


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
                        $set_id = Map::StoreMapset($data);
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
                        $new = Map::StoreMap($data);
                        // On remplace le map_id du tuple correspondant dans 'mappool-maps' avec la map_id récupérer

                        if (array_key_exists('map_id', $_GET)){
                            Mappool::updateMapUrl($_GET['map_id'], $_GET['pool_id'], $new);
                        }else{
                            $data = [
                            'position' => $_GET['position'],
                            'user_id' => $_SESSION['user']->osu_id,
                            'mode' => $_POST['mode'],
                            'pool_id' => $_GET['pool_id'],
                            'map_id' => Map::getMapWithUrl($_POST['url'])];
                            Mappool::storeNewMappool_maps($data);

                        }


                    }

                    }else{

                // On remplace le map_id du tuple correspondant dans 'mappool-maps' avec la map_id récupérer
                if (array_key_exists('map_id', $_GET)){
                    $new = Map::getMapWithUrl($_POST['url']);

                    Mappool::updateMapUrl($_GET['map_id'], $_GET['pool_id'], $new);
                }else{
                        $data = [
                            'position' => $_GET['position'],
                            'user_id' => $_SESSION['user']->osu_id,
                            'mode' => $_POST['mode'],
                            'pool_id' => $_GET['pool_id'],
                            'map_id' => Map::getMapWithUrl($_POST['url'])];
                        Mappool::storeNewMappool_maps($data);



                }

            }

        }


        if (array_key_exists('mode', $_POST)) {
            // Remplacer le mode là ou les infos correspondent
            if (array_key_exists('map_id', $_GET)){
                $poopool = new Mappool($_GET['pool_id']);
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
            Mappool::storeNewPool($data);

        }

        $this->show_edit();

    }





}