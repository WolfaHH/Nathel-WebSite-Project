<?php


namespace Nathel;



abstract class Connexion extends Controller
{
    private static function connect_user()
    {
        $tmp = $_SESSION['OsuApi']->getOwnUserInfo($_SESSION['token'])['user_id']; // si token marche pas, erreur, rafraichir token
        $_SESSION['user'] = new User($tmp);

    }

    public static function login_button()
    {
        // Fonction verif token_user not expired
        $OsuApi = $_SESSION['OsuApi'];
        $api = $OsuApi->getOwnUserInfo($_SESSION['token']);
        $id = $api['user_id'];
        if ((User::checkUser($id)) == False){

            //make data user and store user
            $data = array();
            User::storeUser($data);

        }

        $tmp = $OsuApi->getOwnUserInfo($_SESSION['token']);
        $_SESSION['user'] = new User($tmp['user_id']);

        $ch = $_SESSION['REQUEST_URI'];
        header('Location: '.$ch);

    }

    public static function verif_login_page()
    {
        if (isset($_SESSION['user'])) {
            Controller::updateSession();
        } elseif ($_COOKIE['token_user']) {
            $_SESSION['$token_user'] = $_COOKIE['token_user'];
            $_SESSION['refresh_token_user'] = $_COOKIE['$refresh_token_user'];
            self::connect_user();
        }
    }

}
