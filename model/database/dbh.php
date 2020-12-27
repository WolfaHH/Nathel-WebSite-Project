<?php

namespace Nathel;

use \PDO;

abstract class Dbh {
    protected $host = "localhost";
    protected $user = "root";
    protected $pwd = "";
    protected $dbName = "nathel_mappool";

    protected static function connectToDb(){
        $dsn = 'mysql:host=' . self::host . ';dbname=' . self::dbName;
        $pdo = new PDO($dsn, self::user, self::pwd);
        $pdo->setAttribute(PDO::ATR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

?>