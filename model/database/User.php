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

    public function getUser()
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
        $stmt = self::connectToDb()->prepare('SELECT * FROM user_scores us INNER JOIN mappool_maps mm ON us.mappool_map_id = mm.id WHERE us.user_id = :user_id AND mm.id = :mappool_id');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->bindParam(':mappool_id', $mappool->id);
        $stmt->execute();
        return $stmt->fetchAll();
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

    public function getUserMappools()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools WHERE user_id = :user_id  ');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserFollows()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappool_followed WHERE user_id = :user_id  ');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserFollowedMappools()
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappool_followed mf INNER JOIN mappools ON mf.mappool_id = mappools.id WHERE mf.user_id = :user_id');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    public static function storeUser($data)
    {
        $stmt = self::connectToDb()->prepare('INSERT INTO users (name, email, password, thumbnail, `rank`, country) VALUES (:name, :email, :password, :thumbnail, :rank, :country)');
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':thumbnail', $data['thumbnail']);
        $stmt->bindParam(':rank', $data['rank']);
        $stmt->bindParam(':country', $data['country']);
        $stmt->execute();
    }

    public function storeUserFollow($mappool_id)
    {
        $stmt = self::connectToDb()->prepare('INSERT INTO  mappool_followed (user_id, mappool_id) VALUES (:user_id, :mappool_id)');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->bindParam(':mappool_id', $mappool_id);
        $stmt->execute();
    }

    public function storeUserInvitation($receiver_id, $collection_id)
    {
        $stmt = self::connectToDb()->prepare('INSERT INTO  invitations (sender_id, receiver_id, collection_id) VALUES (:sender_id, :receiver_id, :collection_id)');
        $stmt->bindParam(':sender_id', $this->id);
        $stmt->bindParam(':receiver_id', $receiver_id);
        $stmt->bindParam(':collection_id', $collection_id);
        $stmt->execute();
    }

    public function storeUserScore($mappool_map_id, $data)
    {
        $stmt = self::connectToDb()->prepare('INSERT INTO  user_scores (user_id, mappool_map_id, score, note, accuracy, combo, `statistics.count_300`, `statistics.count_100`, `statistics.count_50`, miss) VALUES (:user_id, :mappool_map_id, :score, :note, :accuracy, :combo, :count_300, :count_100, :count_50, :miss)');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->bindParam(':mappool_map_id', $mappool_map_id);
        $stmt->bindParam(':score', $data['score']);
        $stmt->bindParam(':note', $data['note']);
        $stmt->bindParam(':accuracy', $data['accuracy']);
        $stmt->bindParam(':count_300', $data['count_300']);
        $stmt->bindParam(':count_100', $data['count_100']);
        $stmt->bindParam(':count_50', $data['count_50']);
        $stmt->bindParam(':miss', $data['miss']);
        $stmt->execute();
    }

    public function storeContributor($collection_id)
    {
        $stmt = self::connectToDb()->prepare('INSERT INTO contributors (user_id, collection_id) VALUES (:user_id, :collection_id)');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->bindParam(':collection_id', $collection_id);
        $stmt->execute();
    }



    public static function updateUser($id, $data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('UPDATE users SET name = :name, email = :email, password = :password, thumbnail = :thumbnail, rank = :rank, country = :country, updated_at = NOW() WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':thumbnail', $data['thumbnail']);
        $stmt->bindParam(':rank', $data['rank']);
        $stmt->bindParam(':country', $data['country']);
        return $stmt->execute();
    }

    public function updateUserScore($mappool_map_id, $data)
    {
        $stmt = self::connectToDb()->prepare('UPDATE user_scores SET score = :score, note = :note, accuracy = :accuracy, combo = :combo, `statistics.count_300` = :count_300, `statistics.count_100` = :count_100, `statistics.count_50` = :count_50, miss = :miss WHERE user_id = :user_id AND mappool_map_id = :mappool_map_id');
        $stmt->bindParam(':sender_id', $this->id);
        $stmt->bindParam(':mappool_map_id', $mappool_map_id);
        $stmt->bindParam(':score', $data['score']);
        $stmt->bindParam(':note', $data['note']);
        $stmt->bindParam(':accuracy', $data['accuracy']);
        $stmt->bindParam(':count_300', $data['count_300']);
        $stmt->bindParam(':count_100', $data['count_100']);
        $stmt->bindParam(':count_50', $data['count_50']);
        $stmt->bindParam(':miss', $data['miss']);
        return $stmt->execute();
    }

    public function updateUserInvitation($accept)
    {
        $stmt = self::connectToDb()->prepare('UPDATE invitations SET accept = :accept, deleted_at = null WHERE receiver_id = :receiver_id');
        $stmt->bindParam(':receiver_id', $this->id);
        $stmt->bindParam(':accept', $accept);
        return $stmt->execute();
    }



    private function deleteUserScores()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM user_scores WHERE user_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    private function deleteUserFollows()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM mappool_followed WHERE user_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function deleteUser()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $this->deleteUserScores();
        $this->deleteUserFollows();
    }

    public function deleteContributor($collection_id)
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM contributors WHERE user_id = :user_id AND collection_id = :collection_id');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->bindParam(':collection_id', $collection_id);
        $stmt->execute();
    }

    public function deleteInvitation($collection_id)
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM invitations WHERE receiver_id = :receiver_id AND collection_id = :collection_id');
        $stmt->bindParam(':receiver_id', $this->id);
        $stmt->bindParam(':collection_id', $collection_id);
        return $stmt->execute();
    }

    public function deleteUserFollow($mappool_id)
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM mappool_followed WHERE user_id = :id AND mappool_id = :mappool_id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':mappool_id', $mappool_id);
        $stmt->execute();
    }
}

