<?php


namespace Nathel;


class UserController extends Controller
{
    protected function setUser($params)
    {
        if (isset($params['id'])) {
            return new User($params['id']);
        } else if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            $this->error();
            die();
        }
    }

    public function showUser($params)
    {
        // traitement de donnée
        self::Register();
        self::updateSession();

        $user = $this->setUser($params);

        // appel visuel de la page
        View::header();

        UserView::banner($user);

        UserView::activity($user);

        $mappools = $user->getUserMappools();
        foreach ($mappools as $mappool_user) {
            $mappool = new Mappool($mappool_user['id']);
            MappoolView::show($mappool);
        }

        $mappools = $user->getUserFollowedMappools();
        foreach ($mappools as $mappool_user) {
            $mappool = new Mappool($mappool_user['id']);
            MappoolView::show($mappool);
        }

        View::footer();

    }
}