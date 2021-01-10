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
            die();
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


}