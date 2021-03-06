<?php

namespace Lefty\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Lefty\User\HTMLForm\UserLoginForm;
use Lefty\User\HTMLForm\CreateUserForm;
use Lefty\User\HTMLForm\UpdateUserForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UserController implements ContainerInjectableInterface
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

        $createLink = "<p><a href='user/create'>Create user</a></p>";
    
        $page->add("anax/v2/article/default", [
            "content" => $createLink,
        ]);

        return $page->render([
            "title" => "A index page",
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
    public function listActionGet() : object
    {
        // Force login to access route
        $session = $this->di->get("session");
        if (!$session->get("login"))
        {
            $this->di->get("response")->redirect("user/login")->send();
        }

        $userIdsession = $session->get("userID");

        $page = $this->di->get("page");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        

        $page->add("user/crud/view-all", [
            "items" => $user->findAll(),
            "userIdsession" => $userIdsession
        ]);

        return $page->render([
            "title" => "Users",
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
    public function logoutAction() : object
    {
        $session = $this->di->get("session");
        $session->destroy();
        $this->di->get("response")->redirect("")->send();
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
        $form = new CreateUserForm($this->di);
        $form->check();

        $page->add("anax/v2/article/default", [
            "content" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "A create user page",
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

        // Compare session user to user being edited. If user is 
        // trying to edit some other user it should not succeed
        $userIdsession = $session->get("userID");
        if ($userIdsession != $id)
        {

            $page->add("anax/v2/article/default", [
                "content" => "You can only edit your own profile",
                ]);
                
                return $page->render([
                    "title" => "A info page",
                    ]);
                    
        }

        $form = new UpdateUserForm($this->di, $id);
        $form->check();

        $page->add("user/crud/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update an item",
        ]);
    }
}
