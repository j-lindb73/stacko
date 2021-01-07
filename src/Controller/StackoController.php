<?php

namespace Lefty\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lefty\Post\Post;
use Lefty\Tag\Tag;
use Lefty\User\User;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class StackoController implements ContainerInjectableInterface
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
        
        $latest = $post->getLatest();
        
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $toptags = $tag->getTopTags();


        $topusers = $post->getTopUsers();

        $page->add("post/crud/stats", [
            "items" => $latest,
        ]);
        $page->add("tag/crud/stats", [
            "items" => $toptags,
        ]);
        $page->add("user/crud/stats", [
            "items" => $topusers,
        ]);

        return $page->render([
            "title" => "A index page",
        ]);
    }


}
