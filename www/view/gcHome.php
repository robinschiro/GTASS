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
        <title>Score Table</title>
        <!--<script>
            function myFunction() {

            }
        </script>-->
    </head>

    <body>
        <div class="WRAPPER" >
            <div class="TOP" align="right">
                <?php echo 'Signed in as '.$_SESSION['username'];?><br>
                <a href="/logout">Sign out</a>
            </div>

            <div class="LEFT">
                <p class="sidebar" align="center"><a href="/account">My Account</a></p>
                <p class="sidebar_selected" align="center">Score Table</p>
                <p class="sidebar" align="center"><a href="/gc/incompleteNominations">Incomplete Nominations</a></p>
                <p class="sidebar" align="center"><a href="/gc/allSessions">View All Sessions</a></p>
            </div>



                <?php
                    $isReadOnly = false;
                if ( is_null($session) )
                {
                    echo "<script> alert('There Is No Session That Is Currently Open'); </script>";
                }
                else
                {
                echo '<div class="CENTER" id="tableview">
                        <p class="Form" align="left">
                        Score Table for ' . $sessionID;
                echo '</p>
                    include "../view/scoreTable.php"';

                    echo '<br><br>
                    </div>';
                }
                ?>




            <!-- end center div -->
        </div>
    </body>
</html>
