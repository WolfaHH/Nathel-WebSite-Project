<?php

echo "coucou";


require '../vendor/autoload.php';
$uri = $_SERVER['REQUEST_URI'];
$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');

$match = $router->match();

require './view/template/header.php';
if (is_array($match)) {
$params = $match['params'];
require "./view/elements/{$match['target']}.php";
} else {
require "./view/elements/404.php";
}
require './view/template/footer.php';
