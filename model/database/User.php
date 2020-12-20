<?php


namespace Nathel;


class User extends Dbh
{

    public $id;
    public $name;
    public $email;
    public $thumbnail;
    public $country;
    public $rank;
    public $silver_ss;
    public $silver_s;
    public $ss;
    public $s;
    public $a;
    public $created_at;
    public $updated_at;


    public function __construct($id)
    {
        $this->id = $id;
        $user = $this->getUser();
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->thumbnail = $user['thumbnail'];
        $this->country = $user['country'];
        $this->rank = $user['rank'];
        $this->silver_ss = $user['silver_ss'];
        $this->silver_s = $user['silver_s'];
        $this->ss = $user['ss'];
        $this->s = $user['s'];
        $this->a = $user['a'];
        $this->created_at = $user['created_at'];
        $this->updated_at = $user['updated_at'];
    }

    public static function ConnectUser($email, $password)
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getUsers()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    private function getUser()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserScore($mappool_map_id)
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM user_scores WHERE user_id = :user_id AND mappool_map_id = :mappool_map_id');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->bindParam(':mappool_map_id', $mappool_map_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getUserScores(Mappool $mappool)
    {

    }

    public function getUserInvitations()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM invitations WHERE receiver_id = :user_id');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserCollections()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors cb INNER JOIN collections cl ON cb.collection_id = cl.id WHERE cb.user_id = :user_id  ');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

