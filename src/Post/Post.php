<?php

namespace Lefty\Post;

use Anax\DatabaseActiveRecord\ActiveRecordModel;

/**
 * A database driven model.
 */
class Post extends ActiveRecordModel
{
    /**
    * @var string $tableName name of the database table.
    */
    protected $tableName = "posts";

    /**
    * Columns in the table.
    *
    * @var integer $id primary key auto incremented.
    */
    public $id;
    public $title;
    public $text;
    public $tags;
    public $postTypeId;
    public $userId;
    // public $created;
    // public $updated;
    public $deleted;
    public $active;



    /**
    * Get all posts
    * 
    *
    * @return object with posts
    */

    public function getAll($order = 'p.created', $orderDirection = 'DESC')
    {

        $this->db->connect();

        $res = $this->db->select("p.id AS 'id', postTypeId, parentId, p.title, p.text, p.created, u.acronym")
        ->from("posts As p")
        ->join('users AS u', 'u.id = p.userId')
        ->orderby($order . " " . $orderDirection)
        ->execute()
        ->fetchAll();

        // var_dump($this->db->getSQL());

        return $res;

    }

    /**
    * Get question post
    * 
    * @param int $id post id
    *
    * @return object with question post
    */

    public function getPostQuestion(int $id)
    {

        $this->db->connect();

        $res = $this->db->select("p.id, p.parentId, p.userId, p.title, p.text, u.acronym")
        ->from("posts As p")
        ->where("p.id = " . $id)
        ->join('users AS u', 'u.id = p.userId')
        ->execute()
        ->fetch();

        return $res;

    }

    /**
    * Get post owner
    * 
    * @param int $id post id
    *
    * @return object with post owner
    */

    public function getPostOwner(int $id)
    {

        $this->db->connect();

        $res = $this->db->select("userId")
        ->from("posts")
        ->where("id = " . $id)
        ->execute()
        ->fetch();

        return $res;

    }

    /**
    * Get answers to post
    * 
    * @param int $id parent id
    *
    * @return object with answer posts
    */

    public function getPostAnswers(int $id)
    {

        // $sql = "SELECT * FROM users;";

        // $db = $this->di->get("dbqb");
        $this->db->connect();

        $res = $this->db->select("*")
        ->from("posts")
        ->where("parentId = " . $id)
        ->execute()
        ->fetchAll();

        return $res;

    }

    /**
    * Get latest posts
    * 
    *
    * @return object with latest posts
    */

    public function getLatest($limit = 3)
    {

        $this->db->connect();

        $res = $this->db->select("p.id, p.postTypeId, p.title, p.created, pt.name, u.email")
        ->from("posts AS p")
        ->join("users AS u", "u.id = p.userId")
        ->join("posttypes AS pt", "pt.id = p.postTypeId")
        ->limit($limit)
        ->orderby("created DESC")
        ->execute()
        ->fetchAll();

        return $res;

    }

    /**
    * Get comments to post
    * 
    * @param int $id parent id
    *
    * @return object with comment posts
    */

    public function getPostComments(int $id)
    {

        // $sql = "SELECT * FROM users;";

        // $db = $this->di->get("dbqb");
        $this->db->connect();

        $res = $this->db->select("*")
        ->from("comments")
        ->where("parentId = " . $id)
        ->execute()
        ->fetchAll();

        return $res;

    }

    /**
    * Get user question posts
    * 
    * @param int $id userid
    *
    * @return object with question posts
    */

    public function getUserPosts(int $id)
    {

        $this->db->connect();

        $res = $this->db->select("p.id, p.parentId,  p.postTypeId, p.title, p.text, p.created, u.acronym, pt.name")
        ->from("posts AS p")
        ->where("userId = " . $id)
        ->join("users AS u", "u.id = p.userId")
        ->join("posttypes AS pt", "pt.id = p.postTypeId")
        ->execute()
        ->fetchAll();

        return $res;

    }


        /**
    * Get top users
    * 
    *
    * @return object with top users
    */

    public function getTopUsers($limit = 3)
    {

        $this->db->connect();

        $res = $this->db->select("u.id, u.acronym, u.email, COUNT(*) AS 'count'")
        ->from("posts AS p")
        ->join("users AS u", "u.id = p.userId")
        ->groupby("userId")
        ->limit($limit)
        ->orderby("count DESC")
        ->execute()
        ->fetchAll();

        return $res;

    }
}