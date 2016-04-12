<?php

session_start();

//check role of user
if($_SESSION['role'] != 2)
{
    //if logged in user is a GC member
    if ($_SESSION['role'] == 1)
    {
        //redirect to GC view
        header("Location: /adminHome");
    } // If logged in as nominator
    else if ($_SESSION['role'] == 3)
    {
        header("Location: /addNominees");
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
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
        <title>Score Table</title>
    </head>

    <body>
        <div class="WRAPPER" >
            <div class="TOP" align="right">
                <?php echo 'Signed in as '.$_SESSION['username'];?><br>
                <a href="/logout">Sign out</a>
            </div>

            <div class="LEFT">
                <p class="sidebar_selected" align="center">Score Table</p>
                <p class="sidebar" align="center"><a href="/incompleteNominations">Incomplete Nominations</a></p>
            </div>

            <div class="CENTER" id="tableview">
                <p class="Form" align="left">
                    <?php echo 'Score Table for ' . $sessionID; ?>
                </p>

                <?php
                    include '../view/scoreTable.php';
                ?>


                <br><br>
            </div>


            <!-- end center div -->
        </div>
    </body>
</html>
