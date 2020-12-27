<?php


namespace Nathel;


class UserController extends Controller
{
    protected function setUser()
    {
        if (isset($_GET['id'])) {
            $user = new User($_GET['id']);
        } else if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
        } else {
            $this->error();
        }
    }

    public function showUser()
    {

        self::modelRegister();
        self::viewRegister();
        self::updateSession();

        $this->setUser();

        require_once 'view/template/user.php';

    }
}