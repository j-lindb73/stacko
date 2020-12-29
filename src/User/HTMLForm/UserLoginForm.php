<?php

namespace Lefty\User\HTMLForm;

use Lefty\User\User;
use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
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
                "legend" => "User Login"
            ],
            [
                "user" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],
                        
                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
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
        $email       = $this->form->value("user");
        $password      = $this->form->value("password");
    
        // Try to login
        // $db = $this->di->get("dbqb");
        // $db->connect();
        // $user = $db->select("password")
        //            ->from("User")
        //            ->where("acronym = ?")
        //            ->execute([$acronym])
        //            ->fetch();
        //
        // // $user is false if user is not found
        // if (!$user || !password_verify($password, $user->password)) {
        //    $this->form->rememberValues();
        //    $this->form->addOutput("User or password did not match.");
        //    return false;
        // }
    
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $res = $user->verifyPassword($email, $password);
    
        if (!$res) {
           $this->form->rememberValues();
           $this->form->addOutput("User or password did not match.");
           return false;
        }

        $session = $this->di->get("session");
        $session->set("login", true);
        $session->set("user", $email);
        $session->set("userID", $user->id);
        $session->set("username", $user->acronym);
    
        $this->form->addOutput("User " . $user->acronym . " logged in.");
        return true;
    }

        /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("user")->send();
    }


}
