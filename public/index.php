<?php
require '../vendor/autoload.php';

require '../controller/Autoloader.php';
\Nathel\Autoloader::Register();





$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
$router->map('GET', '/user/[i:id]', 'user', 'user');
$router->map('GET', '/user/update/[i:id]', 'userUpdate', 'userUpdate');
$router->map('GET', '/collection/[i:id]', 'collection', 'collection');
$router->map('GET', '/managemypools', 'managemypools', 'managemypools');

$match = $router->match();


if (is_array($match)) {

    $params = $match['params'];
    var_dump($params);

    if ($match['target'] === 'user') {
        $controller = new Nathel\UserController();
        $controller->showUser($params);
    }

    if ($match['target'] === 'userUpdate') {
        $controller = new Nathel\UserController();
        $controller->Update();
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


/*
    if (isset($match['target'])) {
        $class = ucfirst($match['target']) . 'Controller';
        $controller = new $class();
        $controller->Update();
    }
*/
} else {


    $controller = new Nathel\Controller();
    $controller->error();

}
