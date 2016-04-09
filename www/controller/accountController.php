<?php

require_once('../model/implementation/userServiceImp.php');

if (isset($_POST['changeCredentials']))
{
    $accountCtrl = new accountController();
    $accountCtrl->changeCredentials();
}

class accountController
{
    var $userServ;

    function __construct()
    {
        $this->userServ = new userServiceImp();
    }

    function getCurrentUser()
    {
        return $this->userServ->getUserByID($_SESSION['userID']);
    }
    
    function changeCredentials()
    {
        $currentUser = $this->getCurrentUser();

        $userID = $_SESSION['userID'];
        $newUsername = $_POST['username'];

        // If the password has not been changed, use the previous password.
        $pass = $_POST['password'];
        $newPassword = ($pass == '') ? $currentUser->getPassword() : password_hash($pass, PASSWORD_BCRYPT);

        $newFirstName = $_POST['firstName'];
        $newLastName = $_POST['lastName'];
        $newEmailAddress = $_POST['emailAddress'];

        $this->userServ->updateUser($userID, $newUsername, $newPassword, $newFirstName, $newLastName, $newEmailAddress);

        // Display a success message on the 'account' page.
        $_SESSION['message'] = '<br> Your account has been successfully updated. <br><br>';

        // Redirect to account page.
        header('Location: /account');
    }
}