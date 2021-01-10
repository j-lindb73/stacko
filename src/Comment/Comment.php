<?php

namespace Lefty\Comment;

use Anax\DatabaseActiveRecord\ActiveRecordModel;


/**
 * A database driven model.
 */
class Comment extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "comments";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $userId;
    public $body;
    // public $created;
    // public $updated;
    public $deleted;
    public $active;

    /**
    * Get all comments
    * 
    *
    * @return object with comments
    */

    public function getAll($order = 'c.created', $orderDirection = 'DESC')
    {

        $this->db->connect();

        $res = $this->db->select("c.id, c.parentId, c.userId, c.body, c.created, u.acronym")
        ->from("comments AS c")
        ->join('users AS u', 'u.id = c.userId')
        ->orderby($order . " " . $orderDirection)
        ->execute()
        ->fetchAll();

        // var_dump($this->db->getSQL());

        return $res;

    }

    /**
    * Get comment owner
    * 
    * @param int $id comment id
    *
    * @return object with comment owner
    */

    public function getCommentOwner(int $id)
    {

        $this->db->connect();

        $res = $this->db->select("userId")
        ->from("comments")
        ->where("id = " . $id)
        ->execute()
        ->fetch();

        return $res;

    }

    /**
    * Get session user comments owner
    * 
    * @param int $id userid
    *
    * @return object with user comments
    */

    public function getUserComments(int $id)
    {

        $this->db->connect();

        $res = $this->db->select("id, body")
        ->from("comments")
        ->where("userId = " . $id)
        ->execute()
        ->fetchAll();

        return $res;

    }

}