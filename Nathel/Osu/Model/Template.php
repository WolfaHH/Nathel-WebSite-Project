<?php

namespace Nathel\Osu\Model\Tourney\Database;
use Nathel\Osu\Model\Dbh;

class Tourney extends Dbh{

    public $id;


    public function __construct(){

    }

    /* ##### ALL GET METHODS ##### */

    public function get()
    {
        $stmt = self::connectToDb()->prepare('SELECT FROM WHERE ');
        $stmt->bindParam();
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ##### ALL UPDATE METHODS ##### */

    public static function update(){
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE  SET  WHERE ');
        $stmt->bindParam();
        return $stmt->execute();
    }


    /* ##### ALL STORE METHODS ##### */

    public static function store($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO  () VALUES () ');
        $stmt->bindParam();
        $stmt->execute();
    }

    /* ##### ALL DELETE METHODS ##### */
    public function delete()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM  WHERE ');
        $stmt->bindParam();
        return $stmt->execute();
    }









}



