<!-- This view is rendered by the accountController. -->

<?php

session_start();

//check role of user
$roleID = $_SESSION['role'];
if( ($roleID < 1) || ($roleID > 3) )
{
    header("Location: /");
}


require_once('../controller/accountController.php');
$accountCtrl = new accountController();
$currentUser = $accountCtrl->getCurrentUser();
?>


<html>
<head>
    <link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet" >
    <title>GTASS</title>
</head>

    <body>

    <div class="WRAPPER" >
        <div class="TOP" align="right">
            <?php echo 'Signed in as '.$_SESSION['username'];?><br>
            <a href="/logout">Sign out</a>
        </div>

        <div class="LEFT">
            <p class="sidebar_selected" align="center">My Account</p>

            <?php

            switch ( $roleID )
            {
                case 1:
                {
                    echo '
                    <p class="sidebar" align="center"><a href="/admin/createSession">Create Session</a></p>
                    <p class="sidebar" align="center"><a href="/admin/currentSession">Current Session</a></p>
                    <p class="sidebar" align="center"><a href="/admin/addNominators">Add Nominators</a></p>
                    <p class="sidebar" align="center"><a href="/admin/allSessions">View All Sessions</a></p>';

                    break;
                }

                case 2:
                {
                    echo '
                    <p class="sidebar" align="center"><a href="/gc/gcHome">Score Table</a></p>
                    <p class="sidebar" align="center"><a href="/gc/incompleteNominations">Incomplete Nominations</a></p>';

                    break;
                }

                case 3:
                {
                    echo '
                    <p class="sidebar" align="center"><a href="/nominator/addNominees">Add Nominees</a></p>
                    <p class="sidebar" align="center"><a href="/nominator/approveNominees">Pending Approvals</a></p>';

                    break;
                }
            }


            ?>
        </div>

        <div class="CENTER">
            <p class="Form" align="left">
                My Account
            </p>

            <form action="/accountCtrl" method="POST" >

                <p class="information">

                    <?php
                        echo $_SESSION['message'];
                        $_SESSION['message'] = '';
                    ?>

                    <table>
                        <tr>
                            <td>Username: </td>
                            <td><input type="text" <?php echo 'value="'.$currentUser->getUsername().'"'; ?> name="username"></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" placeholder="Enter new password" name="password"/></td>
                            <td> (leave blank to keep password unchanged) </td>
                        </tr>
                        <tr>
                            <td>First Name: </td>
                            <td><input type="text" <?php echo 'value="'.$currentUser->getFirstName().'"'; ?> name="firstName"></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input type="text" <?php echo 'value="'.$currentUser->getLastName().'"'; ?> name="lastName"></td>
                        </tr>
                        <tr>
                            <td>Email Address: </td>
                            <td><input type="text" <?php echo 'value="'.$currentUser->getEmail().'"'; ?> name="emailAddress"></td>
                        </tr>
                    </table>

                    <br><br>
                </p>

                <!-- Tells the controller which function to call -->
                <input type="hidden" name="changeCredentials">

                <p class="submit" align="center">
                    <input type="submit" value="Save Changes">
                </p>

            </form>


            <br><br>
        </div>


        <!-- end center div -->
    </div>
    </body>
</html>
