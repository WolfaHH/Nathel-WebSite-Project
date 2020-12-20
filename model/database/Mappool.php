<?php

namespace Nathel;

class Mappool extends Dbh{

    public function GetMostPopular($nb){
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY follow DESC LIMIT :nb');
        $stmt->bindParam(':nb',$nb);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetMostRecent($nb){
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY created_at LIMIT :nb');
        $stmt->bindParam(':nb',$nb);
        $stmt->execute();
        return $stmt->fetchAll();

    }

}
