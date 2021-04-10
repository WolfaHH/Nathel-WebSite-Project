<?php


/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;


class UserController extends Controller
{
    protected function setUser($params)
    {

        if (isset($params['id'])) {
            return new Data\User($params['id']);
        } else if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            $this->error();
            die();
        }
    }

    public function showUser($params)
    {

        Control\Controller::storeURI();

        // traitement de donnée
        self::updateSession();

        $user = $this->setUser($params);

        // appel visuel de la page
        View\View::header();

        View\UserView::banner($user);

        View\UserView::activity($user);

        $mappools = $user->getUserMappools();
        View\MappoolView::section($mappools, 'submited Mappools');

        $mappools = $user->getUserFollowedMappools();
        View\MappoolView::section($mappools, 'COMPLETED MAPPOOLS');

        View\View::footer();

    }


}