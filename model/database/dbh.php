<?php

namespace Nathel;

use \PDO;

class Dbh {
    const HOST = 'localhost';
    const USER = 'root';
    const PWD = '';
    const DBNAME = 'nathel_mappool';

    protected static function connectToDb(): PDO
    {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DBNAME;
        $pdo = new PDO($dsn, self::USER, self::PWD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

?>