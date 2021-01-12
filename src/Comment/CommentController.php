<?php

namespace Lefty\Comment;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lefty\Comment\HTMLForm\CreateCommentForm;
use Lefty\Comment\HTMLForm\UpdateCommentForm;
use Lefty\Comment\HTMLForm\DeleteCommentForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class CommentController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var $data description
     */
    //private $data;



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     ;
    // }



    /**
     * Description.
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));

        $page->add("comment/crud/view-all", [
            "items" => $comment->getAll(),
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }



        /**
     * Handler with form to create a comment.
     *
     * @param int $parentId the id to connect comment to.
     *
     * @return object as a response object
     */
    public function createAction(int $parentId) : object
    {
        // Force login to access route
        $session = $this->di->get("session");
        if (!$session->get("login"))
        {
            $this->di->get("response")->redirect("user/login")->send();
        }


        $page = $this->di->get("page");

        $form = new CreateCommentForm($this->di, $parentId);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create question page",
        ]);
    }

        /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        // Force login to access route
        $session = $this->di->get("session");
        if (!$session->get("login"))
        {
            $this->di->get("response")->redirect("user/login")->send();
        }

        $comment = new Comment();
        $comment->setDb($this->di->get("dbqb"));
        $commentOwner = $comment->getCommentOwner($id);
        
        // Compare session user to comment being edited. If user is 
        // trying to edit some other users comment it should not succeed
        $userIdsession = $session->get("userID");

        $page = $this->di->get("page");

        if ($userIdsession != $commentOwner->userId)
        {

            $page->add("anax/v2/article/default", [
                "content" => "You can only edit your own comments",
                ]);
                
                return $page->render([
                    "title" => "A info page",
                    ]);
                    
        }


        $form = new UpdateCommentForm($this->di, $id);
        $form->check();
        

        $page->add("comment/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }

    
    /**
     * Handler with form to delete an item.
     *
     * @return object as a response object
     */
    public function deleteAction() : object
    {
        // Force login to access route
        $session = $this->di->get("session");
        if (!$session->get("login"))
        {
            $this->di->get("response")->redirect("user/login")->send();
        }
        
        $page = $this->di->get("page");
        $form = new DeleteCommentForm($this->di);
        $form->check();

        $page->add("comment/crud/delete", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Delete an item",
        ]);
    }

}
