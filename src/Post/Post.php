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
    protected $tableName = "Posts";

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
    * Set the password.
    *
    * @param string $password the password to use.
    *
    * @return void
    */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
    * Verify the acronym and the password, if successful the object contains
    * all details from the database row.
    *
    * @param string $acronym  acronym to check.
    * @param string $password the password to use.
    *
    * @return boolean true if acronym and password matches, else false.
    */
    public function verifyPassword($acronym, $password)
    {
        $this->find("acronym", $acronym);
        return password_verify($password, $this->password);
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

        $res = $this->db->select("p.title, p.text, u.acronym")
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
}