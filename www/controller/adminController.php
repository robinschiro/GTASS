<?php

/**
 * Created by PhpStorm.
 * User: sammy
 * Date: 3/26/2016
 * Time: 3:15 PM
 */
/*
 * check to see what type of request was sent
 * if(isset($_POST['submit'])){
        $adminCtrl = new adminController();
        $adminCtrl->functionCall();
    }
 *
 * Dynamic forms reference: http://www.infotuts.com/dynamically-add-input-fields-submit-to-database/
 *
 */

require_once('../model/implementation/emailServiceImp.php');
require_once('../model/implementation/sessionServiceImp.php');
require_once('../model/implementation/userServiceImp.php');
require_once('../model/implementation/nominatorServiceImp.php');

//createSession will be a hidden input field in the create session form
if (isset($_POST['createSession'])) {

    $adminCtrl = new adminController();
    $adminCtrl->createSession();
}

else if(isset ($_POST['createNominators']))
{
    echo "createNominators is set...<br>";
    $adminCtrl = new adminController();
    $adminCtrl->addNominators();
}

class adminController
{

    //Inject necessary services
    var $userServ;
    var $sessionServ;
    var $emailServ;
    var $nominationServ;

    /**
     * Instantiate Services
     * adminController constructor.
     * @param $userServ
     * @param $sessionServ
     */
    public function __construct()
    {
        $this->userServ = new userServiceImp();
        $this->sessionServ = new sessionServiceImp();
        $this->emailServ = new emailServiceImp();
        $this->nominationServ = new nominatorServiceImp();
    }

    // This will convert a date string in the format 'm/d/Y' to a format compatible with SQL.
    private function ConvertToSQLDate($dateString)
    {
        return DateTime::createFromFormat('m/d/Y', $dateString)->format('Y-m-d');
    }

    /**
     * Will make use of the User, Session, Email,... services
     *
     *
     */
    public function createSession()
    {
        //echo "createSession called...<br>";

        //use $_POST[' '] to grab values (names are assumed)
        $sessionID = $_POST['Semester'] . $_POST['Year'];
        $nomDeadline = $this->ConvertToSQLDate($_POST['nomDeadline']);
        $resDeadline = $this->ConvertToSQLDate($_POST['resDeadline']);
        $verDeadline = $this->ConvertToSQLDate($_POST['verDeadline']);
        $chairmanNumber = $_POST['chairman'];  //returns the number in the the list of added users
        $chairman = null;

        //create users
        /*
         * Test:
         * http://www.open-source-web.com/php/php-foreach-loop-through-post-request/
         *
         * if I do:
         * foreach ($_POST as $key => $value) {
         *     Do something with $key and $value
         * }
         *
         * I'll know order
         *
         * along with count
         * name="name[2]"
         *
         */

//        echo '<br><br>';

        $unameList = array();
        $fnameList = array();
        $lnameList = array();
        $pass = array();
        $email = array();

        foreach ($_POST['uname'] as $u) {
            array_push($unameList, $u);
        }

        foreach ($_POST['firstname'] as $f) {
            array_push($fnameList, $f);
        }

        foreach ($_POST['lastname'] as $l) {
            array_push($lnameList, $l);
        }

        foreach ($_POST['password'] as $p) {
            array_push($pass, $p);
        }

        foreach ($_POST['email'] as $e) {
            array_push($email, $e);
        }

        for ($i = 0; $i < $_POST['gcCount']; $i++) {
            $this->userServ->createUser(
                $unameList[$i],
                $pass[$i],
                $fnameList[$i],
                $lnameList[$i],
                $email[$i],
                2       //gc member
            );

            if ($i == $chairmanNumber) {
                $chairman = $unameList[$i];  //use in the create service function
            }

            $tempData = array();
            array_push($tempData, $unameList[$i]);
            array_push($tempData, $pass[$i]);


            //Send email to users using above arrays to create email
            //$this->emailServ->sendEmail($email[$i], "GTASS Account Created", "You are a GC member. Your GTASS account has been created.");
            $this->emailServ->sendEmail($email[$i], 1, $tempData);
//            echo 'Sent email to ' . $unameList[$i] . '<br>';
        }


        //create session
        $this->sessionServ->createSession($sessionID, $nomDeadline, $resDeadline, $verDeadline, $chairman, $unameList);

        // Retrieve the current session.
        $session = $this->sessionServ->getCurrentSession();

        //redirect to current session static page
        include '../view/currentSession.php';
    }

    /**
     * Returns a session object
     *
     * called in the static session page
     */
    function currentSession()
    {
        //get current session
        //return $this->sessionServ->getService();

    }

    /**
     * Will add new nominators to user table
     */
    function addNominators()
    {
        echo '<br><br>';

        $unameList = array();
        $fnameList = array();
        $lnameList = array();
        $pass = array();
        $email = array();

        foreach ($_POST['uname'] as $u) {
            array_push($unameList, $u);
        }

        foreach ($_POST['firstname'] as $f) {
            array_push($fnameList, $f);
        }

        foreach ($_POST['lastname'] as $l) {
            array_push($lnameList, $l);
        }

        foreach ($_POST['password'] as $p) {
            array_push($pass, $p);
        }

        foreach ($_POST['email'] as $e) {
            array_push($email, $e);
        }

        for ($i = 0; $i < $_POST['count']; $i++) {
            $this->userServ->createUser(
                $unameList[$i],
                $pass[$i],
                $fnameList[$i],
                $lnameList[$i],
                $email[$i],
                3       //nominator
            );

            $tempData = array();
            array_push($tempData, $unameList[$i]);
            array_push($tempData, $pass[$i]);

            //Send email to users using above arrays to create email
            //$this->emailServ->sendEmail($email[$i], "GTASS Account Created", "You are now a nominator. Your GTASS account has been created.");
            $this->emailServ->sendEmail($email[$i], 2, $tempData);
            //echo 'Sent email to ' . $unameList[$i] + '<br>';
        }


    }
}