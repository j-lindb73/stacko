<?php

namespace Lefty\Tag;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Tag extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "Tags";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $tag;

}