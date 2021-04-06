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
            foreach ($maps as $mamap){
                $map = new Map($mamap['id']);

                include '../view/elements/create_collection/map.php';
            }



        }
        include '../view/elements/create_collection/endform.php';




        include '../view/elements/create_collection/addnewpool.php';

        View::footer();
    }

    public function show_edited(){
        Controller::storeURI();
        View::header();


        echo 'la page a été bien éditée !!';

        View::footer();
    }
    public function create_pool(){
    }
    public function edit_pools(){
    }




}