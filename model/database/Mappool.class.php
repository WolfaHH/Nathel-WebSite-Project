<?php
include 'Dbh.class.php';

class Mappool extends Dbh{

    public function __construct($mappool_id){

}

    public static function GetMostPopular(){ // REgler probleme $nb
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY follow DESC LIMIT 5');
        //$stmt->bindParam(':nb', $nb);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetMostRecent(){
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY created_at LIMIT 5');
        //$stmt->bindParam(':nb', $nb);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function GetMapsFromMappool($mappool_id){
        $stmt = $this->connectToDb()->prepare('SELECT * FROM mappool_maps WHERE mappool_id = :mappool_id ORDER BY mode');
        $stmt->bindParam(':mappool', $mappool_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetNbMaps($mappool_id){
        $stmt = $this->connectToDb()->prepare('SELECT COUNT(*) FROM mappool_maps WHERE mappool_id = :mappool_id');
        $stmt->bindParam(':mappool', $mappool_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetCollectionInfoFromAPool($collection_id){
        $stmt = $this->connectToDb()->prepare('SELECT * FROM collections WHERE id = :collection_id');
        $stmt->bindParam(':collection_id', $collection_id);
        $stmt->execute();
        return $stmt->fetch();
    }

}
?>