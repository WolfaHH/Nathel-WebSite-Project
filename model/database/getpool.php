<?php

class GetPool extends Dbh{

    public function GetMostPopular($nb){
        $stmt = $this->connectToDb()->prepare('SELECT TOP $nb popularity FROM mappools');
        $stmt->execute();
        $user = $stmt->fetch();
    }

    public function GetMostRecent($nb){
        $stmt = $this->connectToDb()->prepare('SELECT * FROM mappools ORDER BY created_at LIMIT $nb');
        $stmt->execute();
        $user = $stmt->fetch();

    }

}
?>