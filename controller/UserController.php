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
        self::updateSession();

        $user = $this->setUser($params);
        // appel visuel de la page
        View::header();

        UserView::banner($user);

        UserView::activity($user);

        $mappools = $user->getUserMappools();
        var_dump($mappools);
        MappoolView::section($mappools, 'submited Mappools');

        $mappools = $user->getUserFollowedMappools();
        MappoolView::section($mappools, 'COMPLETED MAPPOOLS');

        View::footer();

    }


}