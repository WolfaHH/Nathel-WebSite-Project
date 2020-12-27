<?php

namespace Nathel;

abstract class Autoloader
{

    private static function loadModel($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class); // on vire le namespace pour require seulement le fichier de l'objet
            require 'model/database' . $class_name . '.php';
        }
    }

    private static function loadView($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class); // on vire le namespace pour require seulement le fichier de l'objet
            require 'view/' . $class_name . '.php';
        }
    }

    protected static function modelRegister()
    {
        spl_autoload_register(array(__CLASS__, 'loadModel'));
    }

    protected static function viewRegister()
    {
        spl_autoload_register(array(__CLASS__, 'loadView'));
    }


}