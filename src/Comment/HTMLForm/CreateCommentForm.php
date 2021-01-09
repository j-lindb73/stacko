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

        // var_dump($parentId);
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
        $body       = $this->form->rawValue("body");
        

        // Set userid from session
        $userId = $this->di->session->get("userID");
    

        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $comment->body = $body;
        $comment->parentId = $this->parentId;
        $comment->userId = $userId;
        $comment->save();
    
        // $this->form->addOutput("Comment was created.");
        return true;
    }

    /**
    * Callback what to do if the form was successfully submitted, this
    * happen when the submit callback method returns true. This method
    * can/should be implemented by the subclass for a different behaviour.
    */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("post/view/" . $this->parentId)->send();
    }

}
