<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/28/2016
 * Time: 6:52 PM
 *
 * Used on the login page
 *
 */

require_once('../model/implementation/userServiceImp.php');

if (isset($_POST['login']))
{
    $loginCtrl = new loginController();
    $loginCtrl->login();
}
//assume logout is called
//else if(isset($_GET['logout'])){
else
{
    $loginCtrl = new loginController();
    $loginCtrl->logout();
}

class loginController
{

    //inject services
    var $userSrv;

    /**
     * loginController constructor.
     * @param $userSrv
     */
    public function __construct()
    {
        $this->userSrv = new userServiceImp();
    }

    function login()
    {
        $this->userSrv->login($_POST['username'], $_POST['password']);

        //successful login??
        if (isset($_SESSION['userID']))
        {
            if ( isset($_POST['goToAccount']) )
            {
                header("Location: /account");
                return;
            }

            //if logged in user is an admin
            if ($_SESSION['role'] == 1)
            {
                //redirect to admin view
                header("Location: /admin/currentSession");  //go go admin page
            }
            //if logged in user is a GC member
            else if ($_SESSION['role'] == 2)
            {
                //redirect to GC view
                header("Location: /gc/gcHome");
            }
            // If logged in as nominator
            else if ($_SESSION['role'] == 3)
            {
                header("Location: /nominator/addNominees");
            }
            //something went wrong session value role is not valid
            else
            {
                //do something not sure yet
            }
        } else
        {
            //return error
            header("Location: /");

        }
    }

    function logout()
    {
        session_unset();
        session_destroy();
        session_start(); //restart empty session
        header("Location: /");  //back to root index
    }
}
