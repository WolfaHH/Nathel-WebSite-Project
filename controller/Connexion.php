<?php


namespace Nathel;


class Connexion extends Controller
{
    public static function login_button($token, $refresh_token, object $OsuApi)
    {
        // Fonction verif token_user not expired

        $name = $OsuApi->getOwnUserInfo($_SESSION['token'])['name'];
        $need_insert = True;
        foreach(User::getUsers() as $key => $value):
            if ($value['name'] === $name):
                $need_insert = False;
            endif;
        endforeach;
        if ($need_insert === True):
            //make data user and store user
            endif;
        self::connect_user($OsuApi);
    }
    public static function verif_login_page(object $OsuApi)
    {
        if (isset($_SESSION['$token_user']) AND isset($_SESSION['$refresh_token_user'])):
            self::connect_user($OsuApi);
        else:
            if(isset($_COOKIE['$token_user']) AND isset($_COOKIE['$refresh_token_user'])):
                $_SESSION['$token_user'] = $_COOKIE['token_user'];
                $_SESSION['refresh_token_user'] = $_COOKIE['$refresh_token_user'];
            else:
                $OsuApi->user_token = False;
            return False;
            endif;
        endif;
        $OsuApi->user_token = $_SESSION['token_user'];
        self::connect_user($OsuApi);
        return True;

    }

    public static function connect_user(object $OsuApi)
    {
        $tmp = $OsuApi->getOwnUserInfo($_SESSION['token']);
        $_SESSION['user'] = [$tmp['name'], $tmp['id']];


    }
    public function authentification_token()
    {
    }

}
