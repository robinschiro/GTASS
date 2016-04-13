<?php

session_start();

//check role of user
if($_SESSION['role'] != 2)
{
    //if logged in user is a GC member
    if ($_SESSION['role'] == 1)
    {
        //redirect to GC view
        header("Location: /admin/currentSession");
    } // If logged in as nominator
    else if ($_SESSION['role'] == 3)
    {
        header("Location: /nominator/addNominees");
    }
    //Session variable role not recognized as valid
    else{
        //user must resign in
        header("Location: /");
    }
}
?>

<?php

/* Get access to the details of the current session */
require_once ('../controller/gcMemberController.php');

$controller = new gcMemberController();
$currentSession = $controller->sessionServ->getCurrentSession();
$sessionID = $currentSession->getSemester();

?>


<html>
    <head>
        <link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet" >
        <title>Incomplete Nominations</title>
    </head>

    <body>
        <div class="WRAPPER" >
            <div class="TOP" align="right">
                <?php echo 'Signed in as '.$_SESSION['username'];?><br>
                <a href="/logout">Sign out</a>
            </div>

            <div class="LEFT">
                <p class="sidebar" align="center"><a href="/account">My Account</a></p>
                <p class="sidebar" align="center"><a href="/gc/gcHome">Score Table</a></p>
                <p class="sidebar_selected" align="center">Incomplete Nominations</p>
            </div>

            <div class="CENTER">
                <p class="Form" align="left">
                    <?php echo 'Incomplete Nominations for ' . $sessionID; ?>
                </p>

                <p class="information">

                <?php
                    include 'incompleteNominationsTable.php';
                ?>

                </p>

                <br><br>
            </div>


            <!-- end center div -->
        </div>
    </body>
</html>
