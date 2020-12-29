<?php

namespace Nathel;

class Collection extends Dbh
{

    public $id;
    public $name;
    public $thumbnail;
    public $description;
    public $created_at;
    public $updated_at;


    public function __construct($collection_id)
    {
        $this->id = $collection_id;
        $collection = $this->getCollection();
        $this->name = $collection['name'];
        $this->thumbnail = $collection['thumbnail'];
        $this->description = $collection['description'];
        $this->created_at = $collection['created_at'];
        $this->updated_at = $collection['updated_at'];
    }



    public function getCollection(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM collections WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getCollectionMappools(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM mappools WHERE collection_id = :collection_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCollectionContributors(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLastContributor(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id LIMIT 1');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getCollectionCreator(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM contributors WHERE collection_id = :collection_id AND creator = 1');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getCollectionTags(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM collection_tags INNER JOIN tags on collection_tags.tag_id = tags.id WHERE collection_id = :collection_id ORDER BY type');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCollectionTag(): array
    {
        $stmt = self::connectToDb()->prepare('SELECT * FROM collection_tags WHERE collection_id = :collection_id AND tag_id = :tag_id');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTotalFollow(): int
    {
        $stmt = self::connectToDb()->prepare('SELECT COUNT(*) FROM collections INNER JOIN mappools ON collections.id = mappools.collection_id INNER JOIN mappool_followed mf on mappools.id = mf.mappool_id WHERE collections.id = :id GROUP BY mf.user_id');
        $stmt->bindParam(':user_id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }



    public static function storeCollection(User $user, $data)
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO collections (name, thumbnail, description) VALUES (:name, :thumbnail, :description)');
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':thumbnail', $data['thumbnail']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();
        $id = $dbh->lastInsertId();

        $user->storeCreator($id);
    }

    public static function storeNewTag($data): string
    {
        $dbh = self::connectToDb();
        $stmt = $dbh->prepare('INSERT INTO tags (name, type) VALUES (:name, :type)');
        $stmt->bindParam(':collection_id', $data['name']);
        $stmt->bindParam(':tag_id', $data['type']);
        $stmt->execute();
        return $dbh->lastInsertId();
    }

    public function storeCollectionTag($tag_id)
    {
        $stmt = self::connectToDb()->prepare('INSERT INTO collection_tags (collection_id, tag_id) VALUES (:collection_id, :tag_id)');
        $stmt->bindParam(':collection_id', $this->id);
        $stmt->bindParam(':tag_id', $tag_id);
        $stmt->execute();
    }



    public function updateName($name): bool
    {
        $stmt = self::connectToDb()->prepare('UPDATE collections SET name = :name, updated_at = NOW() WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    private function updateDescription(): bool
    {
        $stmt = self::connectToDb()->prepare('UPDATE collections SET description = :description, updated_at = NOW() WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':description', $description);
        return $stmt->execute();
    }



    public function deleteCollection()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM collections WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        $this->deleteCollectionMappools();
        $this->deleteCollectionTags();
        $this->deleteCollectionContributors();
        $this->deleteCollectionInvitation();
    }

    private function deleteCollectionMappools()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM mappools WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    private function deleteCollectionTags()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM collection_tags WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    private function deleteCollectionContributors()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM contributors WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    private function deleteCollectionInvitation()
    {
        $stmt = self::connectToDb()->prepare('DELETE FROM invitations WHERE collection_id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }
}

