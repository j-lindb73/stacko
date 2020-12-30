<?php

namespace Lefty\Post;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lefty\Post\HTMLForm\CreatePostForm;
use Lefty\Post\HTMLForm\UpdatePostForm;
use Lefty\Tag\PostTag;

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

        $questionComments = $post->getPostComments($id);  

        // Get post tags
        $postTag = new PostTag;
        $postTag->setDb($this->di->get("dbqb"));
        
  
        // var_dump($res);
        
        $page->add("post/crud/view-post", [
            "question" => $post->getPostQuestion($id),
            "questionComments" => $post->getPostComments($id),
            "postTags" => $postTag->getPostTags($id),
            "items" => $post->getPostAnswers($id),
        ]);

        return $page->render([
            "title" => "A question",
        ]);
    }

    /**
     * Handler to show user posts.
     *
     * @param int $id the userid to get posts from.
     *
     * @return object as a response object
     */
    public function userAction(int $id) : object
    {
        $page = $this->di->get("page");
        $post = new Post();
        $post->setDb($this->di->get("dbqb"));
        
        $posts = $post->getUserPosts($id);
    

         
        // var_dump($res);
        
        $page->add("post/crud/view-list", [
            "items" => $post->getUserPosts($id),
 
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
        // Force login to access route
        $session = $this->di->get("session");
        if (!$session->get("login"))
        {
            $this->di->get("response")->redirect("user/login")->send();
        }

        $page = $this->di->get("page");
        $request = $this->di->get("request");
        // var_dump($request);
        $parentId = $request->getGet('id', null);

        var_dump($parentId);
        // Check if post if question or answer. Answers should not be able to tag
        $tagStatus = isset($parentId) ? "hidden" : "text";

        $form = new CreatePostForm($this->di, $parentId, $tagStatus);
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

