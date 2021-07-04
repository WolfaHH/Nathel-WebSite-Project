<?php

/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;


/* LOADING OBJECT */
require_once '../vendor/autoload.php';
//require '../controller/Autoloader.php';



/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;
use AltoRouter;

//die('je meurs bruhhhh');

// \Nathel\Autoloader::Register();

/* ACTIVE THIS WHEN YOU WANT TO DEBUG */
//echo'<br><br><br><br>';



/* STARTING USER SESSION AND REFRESH USER CONNECTION*/
session_start();


if (isset($_SESSION['OsuApi']) === False){

    $_SESSION['OsuApi'] = new Api\OsuApi(); // A term, bascu user token de osu Api dans classe user

}



Control\ConnexionController::verif_login_page();



/* ROOTING MAP*/

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
$router->map('GET', '/user/[i:id]', 'user', 'user');
$router->map('GET', '/user/update/[i:id]', 'userUpdate', 'userUpdate');
$router->map('GET', '/collection/[i:id]', 'collection', 'collection');
$router->map('GET', '/create', 'create', 'create');
$router->map('POST', '/create', 'created', 'created');
$router->map('GET', '/yourpools', 'yourpools', 'yourpools');
$router->map('GET', '/connexion', 'connexion', 'connexion');
$router->map('GET', '/edit/[i:id]', 'edit', 'edit');
$router->map('POST', '/edit/[i:id]', 'edited', 'edited');
$router->map('GET', '/search', 'search', 'search');


$match = $router->match();

/*
$match ['param'] -> request _GET or _POST
 */

//$_SESSION['user']->osu_id = 1;

if (is_array($match)) {

    $params = $match['params'];



    if ($match['target'] === 'user') {
        if (Data\User::checkUser($params['id']) === False){
            Control\Controller::error();
        }
        else{
            $controller = new Control\UserController();
            $controller->showUser($params);
        }

    }

    if ($match['target'] === 'userUpdate') { // Utilité ?
        $controller = new Control\UserController();
        $controller->Update(); // a f aire
    }

    if ($match['target'] === 'home') {
        $controller = new Control\HomeController();
        $controller->showHome();
    }
    if ($match['target'] === 'collection') {
        if (Data\Collection::checkCollection($params['id']) === False){
            Control\Controller::error();
        }
        else{
            $controller = new Control\CollectionController();
            $controller->showCollectionPage($params);
        }


    }

    if ($match['target'] === 'yourpools') {

        Data\User::checkLogged();
        $controller = new Control\ManagePoolsController();
        $controller->showManagePools();
    }
    if ($match['target'] === 'create') {
        Data\User::checkLogged();
        $controller = new Control\CreateCollectionController();
        $controller->show();
    }
    if ($match['target'] === 'created') {

        $controller = new Control\CreateCollectionController();
        $controller->showcreated();
    }
    if ($match['target'] === 'edit') {

        $controller = new Control\ManagePoolsController();
        $controller->show_edit();
    }
    if ($match['target'] === 'edited') {

        $controller = new Control\ManagePoolsController();
        $controller->show_edited();
    }

    if ($match['target'] === 'connexion') {
        if (isset($_GET['error']) === True && $_GET['error'] === 'access_denied'){
            Control\Controller::error();
        }
        else{
            Control\ConnexionController::login_button();
        }

    }
    if ($match['target'] === 'search') {

        Control\SearchCollectionsController::showSearchCollections();
    }




/*
    if (isset($match['target'])) {
        $class = ucfirst($match['target']) . 'Controller';
        $controller = new $class();
        $controller->Update();
    }
*/
} else {
    Control\Controller::error();
}
