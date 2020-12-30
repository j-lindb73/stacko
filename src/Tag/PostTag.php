<?php

namespace Lefty\Tag;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class PostTag extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "PostTags";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $post_id;
    public $tag_id;

    
    /**
    * Get post tags
    * 
    * @param int $id post id
    *
    * @return object with post tags
    */

    public function getPostTags(int $id)
    {

        // $sql = "SELECT * FROM users;";

        // $db = $this->di->get("dbqb");
        $this->db->connect();

        $res = $this->db->select("t.tag, pt.*")
        ->from("posttags AS pt")
        ->where("post_id = " . $id)
        ->join("tags AS t", "pt.tag_id = t.id ")
        ->execute()
        ->fetchAll();

        return $res;

    }

        /**
    * Get tag posts
    * 
    * @param int $id tag id
    *
    * @return object with tag posts
    */

    public function getTagPosts(int $id)
    {

        $this->db->connect();

        $res = $this->db->select("p.id AS post_id, p.title, pt.id, u.acronym, u.email")
        ->from("posttags AS pt")
        ->where("tag_id = " . $id)
        ->join("tags AS t", "pt.tag_id = t.id ")
        ->join("posts AS p", "p.id = pt.post_id ")
        ->join("users AS u", "u.id = p.userId ")
        ->execute()
        ->fetchAll();

        return $res;

    }
}