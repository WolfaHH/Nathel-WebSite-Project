<?php


namespace Nathel;


class UserController extends Controller
{
    protected function setUser()
    {
        if (isset($_GET['id'])) {
            return new User($_GET['id']);
        } else if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            $this->error();
        }
    }

    public function showUser()
    {

        self::modelRegister();
        self::viewRegister();
        self::updateSession();

        $user = $this->setUser();


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

    }
}