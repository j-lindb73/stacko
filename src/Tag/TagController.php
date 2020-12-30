<?php

namespace Lefty\Tag;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagController implements ContainerInjectableInterface
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
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));



        $page->add("tag/crud/view-all", [
            "items" => $tag->getTags()
        ]);

        return $page->render([
            "title" => "A collection of items",
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
     * Handler to list post with specific tag
     *
     * @param int $id the tag id.
     *
     * @return object as a response object
     */
    public function listAction(int $id) : object
    {
        $page = $this->di->get("page");
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));
        $tag->find("id", $id);
        // var_dump($tag->tag);

        $posttag = new PostTag();
        $posttag->setDb($this->di->get("dbqb"));
        // $posts = $posttag->findAllWhere("tag_id = ?", $tag->id);

        $posts = $posttag->getTagPosts($id);
        // var_dump($posts);



        $page->add("tag/crud/view-list", [
            "tag" => $tag->tag,
            "items" => $posts
        ]);

        return $page->render([
            "title" => "List posts with tag",
        ]);
    }
}

