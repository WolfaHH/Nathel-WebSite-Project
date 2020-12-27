<?php

require '../vendor/autoload.php';
$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');
$router->map('GET', '/user/[i:id]', 'user/show', 'user');

$match = $router->match();

require './view/elements/header.php';
if (is_array($match)) {
$params = $match['params'];
require "./view/template/{$match['target']}.php";
} else {
require "./view/template/404.php";
}
require './view/elements/footer.php';
