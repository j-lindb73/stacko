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

}