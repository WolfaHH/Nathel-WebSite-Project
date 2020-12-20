<?php

namespace Nathel;

class Mappool extends Dbh{

    public $id;
    public $collection_id;
    public $name;
    public $thumbnail;
    public $follow;
    public $created_at;
    public $updated_at;
    public $submitter;


    public function __construct($mappool_id){
        $this->id = $mappool_id;
        $mappool = $this->getMappool();
        $this->name = $mappool['name'];
        $this->collection_id = $mappool['collection_id'];
        $this->thumbnail = $mappool['thumbnail'];
        $this->follow = $mappool['follow'];
        $this->created_at = $mappool['created_at'];
        $this->updated_at = $mappool['updated_at'];
        $this->updated_at = $mappool['submitter'];
        }

    private function getMappool()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function GetMostPopular($nb){
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY follow DESC LIMIT :nb');
        $stmt->bindParam(':nb',$nb);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function GetMostRecent($nb){
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY created_at LIMIT :nb');
        $stmt->bindParam(':nb',$nb);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function GetMaps(){
        $stmt = $this->connectToDb()->prepare('SELECT * FROM mappool_maps WHERE mappool_id = :mappool_id ORDER BY mode');
        $stmt->bindParam(':mappool', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetCollection(){
        $stmt = $this->connectToDb()->prepare('SELECT * FROM collections WHERE id = :collection_id');
        $stmt->bindParam(':collection_id', $this->collection_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function StoreMap(){}
    //public function StoreFollow(){}

    public function UpdateUpdated_at(){}
    public function UpdateThumbnail(){}
    public function UpdateName(){}

    public function DeleteMap(){}
    public function DeleteMappool(){}




}
?>

}
