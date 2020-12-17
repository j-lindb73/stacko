<?php

namespace Lefty\Comment\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Lefty\Comment\Comment;

/**
 * Example of FormModel implementation.
 */
class CreateCommentForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     *      
     */

     public $parentId;

    public function __construct(ContainerInterface $di, $parentId = null)
    {
        parent::__construct($di);

        var_dump($parentId);
        $this->parentId = $parentId;

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create comment",
            ],
            [
                "body" => [
                    "type"        => "text",
                ],

                "parentId" => [
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
        $body       = $this->form->value("body");
        

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
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->body = $body;
        $comment->parentId = $this->parentId;
        $comment->userId = $userId;
        // $user->setPassword($password);
        $comment->save();
    
        $this->form->addOutput("Comment was created.");
        return true;
    }
}
