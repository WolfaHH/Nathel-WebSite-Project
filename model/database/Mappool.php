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


    public function __construct($mappool){

        if (is_array($mappool) === true){
            $this->id = $mappool['id'];
        } else {
            $this->id = $mappool;

            $mappool = $this->getMappool();

        }

        $this->name = $mappool['name'];
        $this->collection_id = $mappool['collection_id'];
        $this->thumbnail = $mappool['thumbnail'];
        $this->follow = $mappool['follow'];
        $this->created_at = $mappool['created_at'];
        $this->updated_at = $mappool['updated_at'];
        $this->submitter = $mappool['user_id'];
        }

    private function getMappool()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }



    public static function GetMostPopular()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY follow DESC LIMIT 5');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function GetMostRecent()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools ORDER BY created_at LIMIT 5');
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function GetMaps()
    {
        $stmt = $this->connectToDb()->prepare('SELECT * FROM mappool_maps WHERE mappool_id = :mappool_id');
        $stmt->bindParam(':mappool_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetNbMaps()
    {
        $stmt = $this->connectToDb()->prepare('SELECT COUNT(*) FROM mappool_maps WHERE mappool_id = :mappool_id');
        $stmt->bindParam(':mappool_id', $this->id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function GetCollection()
    {
        $stmt = $this->connectToDb()->prepare('SELECT * FROM collections WHERE id = :collection_id');
        $stmt->bindParam(':collection_id', $this->collection_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function updateMapUrl($map_id, $pool_id, $new){
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE mappool_maps SET map_id = :new WHERE map_id = :map_id AND mappool_id = :mappool_id');
        $stmt->bindParam(':mappool_id', $pool_id);
        $stmt->bindParam(':map_id', $map_id);
        $stmt->bindParam(':new', $new);
        return $stmt->execute();
    }

    public function UpdateMapMode($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE mappool_maps SET mode = :mode WHERE mappool_id = :id AND map_id = :map_id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':map_id', $data['map_id']);
        $stmt->bindParam(':mode', $data['mode']);
        return $stmt->execute();
    }

    public function UpdateUpdated_at($update)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE mappools SET updated_at = :updated_at WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':updated_at', $update);
        return $stmt->execute();

    }
    public function UpdateThumbnail($thumb)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE mappools SET thumbnail = :thumbnail WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':thumbnail', $thumb);
        return $stmt->execute();

    }
    public function UpdateName($name)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE mappools SET name = :name WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public static function storeNewPool($data)
    {

        $data['col_id'] = (int)$data['col_id'];

        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO mappools (collection_id, name, thumbnail, user_id) VALUES (:col_id, :name, :thumbnail, :user_id) ');
        $stmt->bindParam(':col_id', $data['col_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':thumbnail', $data['thumbnail']);
        $stmt->execute();


    }

    public static function storeNewMappool_maps($data)
    {

        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO mappool_maps (mappool_id, map_id, user_id, mode, position) VALUES (:pool_id, :map_id, :user_id, :mode, :position)');
        $stmt->bindParam(':mode', $data['mode']);
        $stmt->bindParam(':pool_id', $data['pool_id']);
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':map_id', $data['map_id']);
        $stmt->bindParam(':position', $data['position']);
        $stmt->execute();


    }

    public function DeleteMappool()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM mappools WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function deleteMappool_maps()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM mappool_maps WHERE mappool_id = :id');
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function deleteUserScoresOfMappool()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM user_scores AS u INNER JOIN mappool_maps as m ON m.id = u.mappool_map_id WHERE m.mappool_id = :id');
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }








}


