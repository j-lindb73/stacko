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

}