<?php

namespace Lefty\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lefty\Post\HTMLForm\CreatePostForm;
use Lefty\Post\HTMLForm\UpdatePostForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class PostController implements ContainerInjectableInterface
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
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));

        $page->add("post/crud/view-all", [
            "items" => $post->findAll(),
        ]);

        return $page->render([
            "title" => "A collection of items",
        ]);
    }


        /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function viewAction(int $id) : object
    {
        $page = $this->di->get("page");
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));
        
        $question = $post->getPostQuestion($id);
        // $questionOwnerId = $post->getPostOwner($id);
        
  

  
        // var_dump($res);
        
        $page->add("post/crud/view-post", [
            "question" => $post->getPostQuestion($id),
            "items" => $post->getPostAnswers($id),
        ]);

        return $page->render([
            "title" => "A question",
        ]);
    }


    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function loginAction() : object
    {
        $page = $this->di->get("page");
        $form = new UserLoginForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A login page",
        ]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return object as a response object
     */
    public function createAction() : object
    {
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        // var_dump($request);
        $parentId = $request->getGet('id', null);

        var_dump($parentId);

        $form = new CreatePostForm($this->di, $parentId);
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
        $form = new UpdatePostForm($this->di, $id);
        $form->check();



        $page->add("post/crud/update", [
            "form" => $form->getHTML(),
            "post_id" => $id
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }
}

