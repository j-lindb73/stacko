<?php

namespace Lefty\Comment;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lefty\Comment\HTMLForm\CreateCommentForm;
use Lefty\Comment\HTMLForm\UpdateCommentForm;

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
     * @param datatype $variable Description
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
            "items" => $comment->findAll(),
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
        $page = $this->di->get("page");
        // $request = $this->di->get("request");
        // // var_dump($request);
        // $parentId = $request->getGet('id', null);

        var_dump($parentId);

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
        $page = $this->di->get("page");
        $form = new UpdateCommentForm($this->di, $id);
        $form->check();
        

        $page->add("comment/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }
}
