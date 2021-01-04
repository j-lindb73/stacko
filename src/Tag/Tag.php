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

    
        /**
    * Get tag info
    * 
    *
    * @return object with tags
    */

    public function getTags()
    {

        $this->db->connect();

        $res = $this->db->select("*")
        ->from("tags")
        ->orderby("count DESC")
        ->execute()
        ->fetchAll();

        return $res;

    }
    
        /**
    * Get top tags
    * 
    *
    * @return object with tags
    */

    public function getTopTags($limit = 3)
    {

        $this->db->connect();

        $res = $this->db->select("*")
        ->from("tags")
        ->limit($limit)
        ->orderby("count DESC")
        ->execute()
        ->fetchAll();

        return $res;

    }

}