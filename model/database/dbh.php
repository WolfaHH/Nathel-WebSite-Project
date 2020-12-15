<?php 

class Dbh {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "nathel_mappool";

    protected function connectToDb(){
        $dsn = 'mysql:host=' . $this->$host . ';dbname=' . $this->$dbName;
        $pdo = new PDO($dsn, $this->$user, $this->$pwd);
        $pdo->setAttribute(PDO::ATR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

?>