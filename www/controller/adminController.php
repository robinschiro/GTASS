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
    $adminCtrl = new adminController();
    $adminCtrl->addNominators();
}
else if ( isset ($_POST['closeSession']) && isset ($_POST['currentSessionID']) )
{
    // Close the current session.
    $adminCtrl = new adminController();
    $adminCtrl->closeCurrentSession();
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
        $SQLDate = '2000-01-01';

        try
        {
            $SQLDate = DateTime::createFromFormat('m/d/Y', $dateString)->format('Y-m-d');
        }
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }

        return $SQLDate;
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
        $nomDeadline = $_POST['nomDeadline'];
        $resDeadline = $_POST['resDeadline'];
        $verDeadline = $_POST['verDeadline'];
        $chairmanNumber = $_POST['chairman'];  //returns the number in the the list of added users
        $chairman = null;

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
                password_hash($pass[$i], PASSWORD_BCRYPT),
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

        //redirect to current session static page
        header('Location: /admin/currentSession');
    }

    // The POST variable 'currentSessionID' should be set before this is called.
    function closeCurrentSession()
    {
        $this->sessionServ->closeSession($_POST['currentSessionID']);

        // Redirect user to current session page.
        header("Location: /admin/currentSession");
    }

    /**
     * Will add new nominators to user table
     */
    function addNominators()
    {
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
                password_hash($pass[$i], PASSWORD_BCRYPT),  //insert hashed password
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
            $this->emailServ->sendEmail($email[$i], 1, $tempData);
            //echo 'Sent email to ' . $unameList[$i] + '<br>';
        }

        // Display a success message.
        $_SESSION['message'] = '<br> All nominator accounts have been successfully created. <br><br>';

        // Redirect to addNominatorsForm page.
        header('Location: /admin/addNominators');
    }
}
