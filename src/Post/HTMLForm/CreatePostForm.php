<?php

namespace Lefty\Post\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lefty\Post\Post;

/**
 * Example of FormModel implementation.
 */
class CreatePostForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create question",
            ],
            [
                "title" => [
                    "type"        => "text",
                ],
                
                "submit" => [
                    "type" => "submit",
                    "value" => "Create question",
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
        $title       = $this->form->value("title");
        
        // Set post type        
        $postTypeId       = 1;
 
        // Set userid until fetched from session
        $userId = 1;
    
        // Check password matches
        // if ($password !== $passwordAgain ) {
        //     $this->form->rememberValues();
        //     $this->form->addOutput("Password did not match.");
        //     return false;
        // }
    
        // Save to database
        // $db = $this->di->get("dbqb");
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // $db->connect()
        //    ->insert("User", ["acronym", "password"])
        //    ->execute([$acronym])
        //    ->fetch();
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));
        $post->title = $title;
        $post->postTypeId = $postTypeId;
        $post->userId = $userId;
        // $user->setPassword($password);
        $post->save();
    
        $this->form->addOutput("Question was created.");
        return true;
    }
}
