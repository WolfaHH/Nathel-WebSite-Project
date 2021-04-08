<?php


/* LOADING OBJECT */
require '../vendor/autoload.php';
require '../controller/Autoloader.php';

\Nathel\Autoloader::Register();

/* ACTIVE THIS WHEN YOU WANT TO DEBUG */
//echo'<br><br><br><br>';

/* STARTING USER SESSION AND REFRESH USER CONNECTION*/
session_start();

if (isset($_SESSION['OsuApi']) === False){

    $_SESSION['OsuApi'] = new \Nathel\OsuApi(); // A term, bascu user token de osu api dans classe user

}



\Nathel\ConnexionController::verif_login_page();



/* ROOTING MAP*/

$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
$router->map('GET', '/user/[i:id]', 'user', 'user');
$router->map('GET', '/user/update/[i:id]', 'userUpdate', 'userUpdate');
$router->map('GET', '/collection/[i:id]', 'collection', 'collection');
$router->map('GET', '/managemypools', 'managemypools', 'managemypools');
$router->map('GET', '/create', 'create', 'create');
$router->map('POST', '/create', 'created', 'created');
$router->map('GET', '/connexion', 'connexion', 'connexion');
$router->map('GET', '/edit/[i:id]', 'edit', 'edit');
$router->map('POST', '/edit/[i:id]', 'edited', 'edited');
$router->map('GET', '/search', 'search', 'search');
$router->map('GET', '/parcoursup', 'parcoursup', 'parcoursup');

$match = $router->match();

/*
$match ['param'] -> request _GET or _POST
 */

if (is_array($match)) {

    $params = $match['params'];



    if ($match['target'] === 'user') {
        $controller = new Nathel\UserController();
        $controller->showUser($params);
    }

    if ($match['target'] === 'userUpdate') {
        $controller = new Nathel\UserController();
        $controller->Update(); // a f aire
    }

    if ($match['target'] === 'home') {
        $controller = new Nathel\HomeController();
        $controller->showHome();
    }
    if ($match['target'] === 'collection') {

        $controller = new Nathel\CollectionController();
        $controller->showCollectionPage($params);
    }

    if ($match['target'] === 'managemypools') {

        $controller = new Nathel\ManagePoolsController();
        $controller->showManagePools();
    }
    if ($match['target'] === 'create') {

        $controller = new Nathel\CreateCollectionController();
        $controller->show();
    }
    if ($match['target'] === 'created') {

        $controller = new Nathel\CreateCollectionController();
        $controller->showcreated();
    }
    if ($match['target'] === 'edit') {

        $controller = new Nathel\ManagePoolsController();
        $controller->show_edit();
    }
    if ($match['target'] === 'edited') {

        $controller = new Nathel\ManagePoolsController();
        $controller->show_edited();
    }

    if ($match['target'] === 'connexion') {

        \Nathel\ConnexionController::login_button();
    }
    if ($match['target'] === 'search') {

        \Nathel\SearchCollectionsController::showSearchCollections();
    }




/*
    if (isset($match['target'])) {
        $class = ucfirst($match['target']) . 'Controller';
        $controller = new $class();
        $controller->Update();
    }
*/
} else {
    \Nathel\Controller::error();
}
