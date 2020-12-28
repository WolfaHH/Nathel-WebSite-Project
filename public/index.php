<?php

echo 'blabla';

require '../controller/controller.php';
require '../controller/UserController.php';

require '../vendor/autoload.php';
require '../controller/controller.php';
$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
$router->map('GET', '/user/[i:id]', 'user', 'user');
$router->map('GET', '/user/update/[i:id]', 'userUpdate', 'userUpdate');

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


/*
    if (isset($match['target'])) {
        $class = ucfirst($match['target']) . 'Controller';
        $controller = new $class();
        $controller->Update();
    }
*/
} else {


    $controller = new Controller();
    $controller->error();

}
