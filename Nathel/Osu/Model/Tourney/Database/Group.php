<?php

namespace Nathel\Osu\Model\Tourney\Database;
use Nathel\Osu\Model\Dbh;

class Group extends Dbh{

    public $id;
    public $tourney_id;
    public $size;

    public function __construct($id){
        $this->id = $id;
        $group = $this->getGroup();
        $this->tourney_id = $group['tourney_id'];
        $this->size = $group['size'];

    }

    /* ##### ALL GET METHODS ##### */

    public function getGroup():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM groups WHERE id = :id');
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getGroupPlayers():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM group_players WHERE group_id = :id ');
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getGroupMatches():array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM group_matches WHERE group_id = :id ');
        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* ##### ALL UPDATE METHODS ##### */
/* template
    public static function update(){
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE  SET  WHERE ');
        $stmt->bindParam();
        return $stmt->execute();
    }
*/

    /* ##### ALL STORE METHODS ##### */

    public static function storeGroup($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO groups (id, tourney_id, size) VALUES (:id, :tourney_id, :size) ');
        $stmt->bindParam(':id',$data['id']);
        $stmt->bindParam(':tourney_id',$data['tourney_id']);
        $stmt->bindParam(':size',$data['size']);
        $stmt->execute();
    }

    public static function storeGroupPlayer($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO group_players (player_id, group_id, ranking) VALUES (:player_id, :group_id,:ranking) ');
        $stmt->bindParam(':player_id',$data['player_id']);
        $stmt->bindParam(':group_id',$data['group_id']);
        $stmt->bindParam(':ranking',$data['ranking']);
        $stmt->execute();
    }

    public static function storeGroupMatch($data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO group_matches (match_id, gorup_id) VALUES (:match_id, :group_id) ');
        $stmt->bindParam(':match_id',$data['match_id']);
        $stmt->bindParam(':group_id',$data['group_id']);
        $stmt->execute();
    }

    /* ##### ALL DELETE METHODS ##### */
    public function deleteGroup()
    {
        $stmt = self::connectToDb()->prepare('DELETE * FROM groups WHERE id = :id ');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteGroupPlayer()
    {
        $stmt = self::connectToDb()->prepare('DELETE * FROM group_players WHERE group_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }

    public function deleteGroupMatch()
    {
        $stmt = self::connectToDb()->prepare('DELETE * FROM gropu_matches WHERE group_id = :id');
        $stmt->bindParam(':id',$this->id);
        return $stmt->execute();
    }









}




