<?php

/******************** NameSpace *********************/
namespace Nathel\Osu\Controller\Mappool;

/******************** Class Alias *********************/
use Nathel\Osu\Controller\Mappool as Control;
use Nathel\Osu\Model\Mappool\Api;
use Nathel\Osu\Model\Mappool\Database as Data;
use Nathel\Osu\View\Mappool as View;

class Autoloader
{

    private static function loader($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {

            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class); // on vire le namespace pour require seulement le fichier de l'objet


            if (str_contains($class_name, 'View')) {

                require '../view/' . $class_name . '.php';

            } elseif (str_contains($class_name, 'Controller')) {

                require '../controller/' . $class_name . '.php';

            } else {
                if ($class_name === 'OsuApi'){
                    require '../model/Api/osu/' . $class_name . '.php';
                } else{
                    require '../model/Database/' . $class_name . '.php';
                }
            }
        }
    }

    public static function Register()
    {
        spl_autoload_register(array(__CLASS__, 'loader'));
    }
}