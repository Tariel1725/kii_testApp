<?php
require_once 'dbSocket.php';

class elements
{
    public $id = null;
    public $title = null;
    public $description = null;
    public $parentId = null;

    public function elementsList($parentId=null){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('SELECT e.`id`, e.`title`, e.`parentId`, ee.`id` as `hasChildren` FROM `elements` e left join `elements` ee on e.`id` = ee.`parentId` WHERE e.`parentId` = :parentId OR (e.`parentId` IS NULL AND :parentId IS NULL)  GROUP BY e.`id`');
        $stmt->execute(['parentId'=>$parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createElement(){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('INSERT INTO `elements` (`title`, `description`, `parentId`) VALUES (:title, :description, :parentId)');
        $stmt->execute(['title'=>$this->title,
                        'description'=>$this->description,
                        'parentId'=>$this->parentId]);
        return $connector->dbSocket->lastInsertId();
    }

    public function updateElement(){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('UPDATE `elements` SET `title` = :title, `description` = :description, `parentId` = :parentId WHERE `id` = :id');
        $stmt->execute(['id'=>$this->id,
                        'title'=>$this->title,
                        'description'=>$this->description,
                        'parentId'=>$this->parentId]);
    }

    public function deleteElement(){
        $connector = new dbSocket();
        $stmt = $connector->dbSocket->prepare('DELETE FROM `elements` WHERE `id` = :?');
        $stmt->execute('$this->id');
    }
}