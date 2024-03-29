<?php


/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;


abstract class ConnexionController extends Controller
{
    private static function connect_user()
    {
        $tmp = $_SESSION['OsuApi']->getOwnUserInfo($_SESSION['token'])['user_id']; // si token marche pas, erreur, rafraichir token
        $_SESSION['user'] = new Data\User($tmp);

    }

    public static function login_button()
    {

        // Fonction verif token_user not expired
        if (isset($_SESSION['OsuApi']) === False){

            $_SESSION['OsuApi'] = new Api\OsuApi();
        }

        $OsuApi = $_SESSION['OsuApi'];
        $token = $OsuApi->getToken($_GET['code']);
        $api = $OsuApi->getOwnUserInfo($token);
        $id = $api['id'];


        if (is_array(Data\User::checkUser($id)) === False) {

            //make data user and store user
            $data = array();
            $data['osu_id'] = $api['id'];
            $data['name'] = $api['username'];
            $data['password'] = $token;
            $data['thumbnail'] = $api['avatar_url'];
            $data['rank'] = $api['statistics']['pp_rank'];
            $data['country'] = $api['country_code'];
            $data['cover'] = $api['cover_url'];
            Data\User::storeUser($data);

        }

        // Création de la session du user
        $_SESSION['user'] = new Data\User($id);
        $_SESSION['user']->token = $token;

        // Création du cookie de sauvegarde

        setcookie('auth', $_SESSION['user']->osu_id);


        if (isset($_SESSION['REQUEST_URI'])){
            header('Location: '. $_SESSION['REQUEST_URI']);
        }else{
            header('Location : /');
        }




    }

    public static function verif_login_page()
    {
        if (isset($_COOKIE['auth'])) {

            // Création de la session

            $_SESSION['user'] = new Data\User($_COOKIE['auth']);

        }
    }


}
