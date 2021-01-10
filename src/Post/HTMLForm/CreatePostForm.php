<?php

namespace Lefty\Post\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lefty\Post\Post;
use Lefty\Tag\Tag;
use Lefty\Tag\PostTag;

/**
 * Example of FormModel implementation.
 */
class CreatePostForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     *      
     */

    public $parentId;

    public function __construct(ContainerInterface $di, $parentId = null, $tagStatus)
    {
        parent::__construct($di);

        // If parentId is present, the post is an answer
        $this->parentId = $parentId;

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create post",
            ],
            [
                "title" => [
                    "type"        => "text",
                ],

                "text" => [
                    "type"        => "text",
                ],

                "tags" => [
                    "type"        => $tagStatus,
                ],

                "parentId" => [
                    "type"        => "hidden",
                ],

                "postTypeId" => [
                    "type"        => "hidden",
                ],
               
                "submit" => [
                    "type" => "submit",
                    "value" => "Submit",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $title       = $this->form->rawValue("title");
        $text       = $this->form->rawValue("text");
        $tags  = $this->form->rawValue("tags");
        
        // Set post type        
        $postTypeId = isset($this->parentId) ? 2 : 1;
        
        
        // Set userid until fetched from session
        $userId = $this->di->session->get("userID");
        
        
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));
        $post->title = $title;
        $post->text = $text;
        // $post->tags = $tags;
        $post->postTypeId = $postTypeId;
        $post->parentId = $this->parentId;
        $post->userId = $userId;

        $post->save();
        
        
        // Add tags to tag table and connection table if post is question

        if ($postTypeId == 1) {
            
            $tags_array  = explode(" ", $tags);
            foreach ($tags_array as $key => $value) {
                $tag = new Tag();
                $tag->setDb($this->di->get("dbqb"));
                $tag->find("tag", $value);
                if (!$tag->tag == $value) {
                    $tag->tag = $value;
                    $tag->count = 1;
                    $tag->save();
                } else {
                    $tag->tag = $value;
                    $tag->count = $tag->count + 1;
                    $tag->save();
                }
                
                $posttag = new PostTag();
                $posttag->setDb($this->di->get("dbqb"));
                $posttag->post_id = $post->id;
                $posttag->tag_id = $tag->id;
                $posttag->save();
                
            }
        }



        // $this->form->addOutput("Post was created...with id " . $post->id);
        return true;
    }

            /**
    * Callback what to do if the form was successfully submitted, this
    * happen when the submit callback method returns true. This method
    * can/should be implemented by the subclass for a different behaviour.
    */
    public function callbackSuccess()
    {

        $this->di->get("response")->redirect("post")->send();
    }
}
