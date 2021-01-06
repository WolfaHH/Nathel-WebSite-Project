<?php


namespace Nathel;


abstract class ConnexionController extends Controller
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
        $_SESSION['token'] = $OsuApi->getToken($_GET['code']);
        $api = $OsuApi->getOwnUserInfo($_SESSION['token']);
        $id = $api['id'];
        if (!is_array(User::checkUser($id))) {

            //make data user and store user
            $data = array();
            $data['osu_id'] = $api['id'];
            $data['name'] = $api['username'];
            $data['password'] = $_SESSION['token'];
            $data['thumbnail'] = $api['avatar_url'];
            $data['rank'] = $api['statistics']['pp_rank'];
            $data['country'] = $api['country_code'];
            $data['cover'] = $api['cover_url'];
            var_dump($data);
            User::storeUser($data);

        }

        $_SESSION['user'] = new User($api['id']); //$api['id'] qd store marchera

        $ch = $_SESSION['REQUEST_URI'];
        header('Location: ' . $ch);

    }

    public static function verif_login_page()
    {
        if (isset($_SESSION['user'])) {
            Controller::updateSession();
        } elseif (isset($_COOKIE['token_user'])) {
            $_SESSION['$token_user'] = $_COOKIE['token_user'];
            $_SESSION['refresh_token_user'] = $_COOKIE['$refresh_token_user'];
            self::connect_user();
        }
    }


}
