<?php

session_start();

//check role of user
if($_SESSION['role'] != 1)
{
    //if logged in user is a GC member
    if ($_SESSION['role'] == 2)
    {
        //redirect to GC view
        header("Location: /gcHome");
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
require_once ('../controller/adminController.php');

 $controller = new adminController();
 $session = $controller->sessionServ->getCurrentSession();
?>


<html>
    <head>
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
        <title>GTASS</title>
    </head>

    <body>
        <div class="WRAPPER" >
            <div class="TOP" align="right">
                <?php echo 'Signed in as '.$_SESSION['username'].' (admin)';?><br>
                <a href="/logout">Sign out</a>
            </div>

            <div class="LEFT">
                <p class="sidebar" align="center"><a href="/adminHome">Home</a></p>
                <p class="sidebar" align="center"><a href="/createSession">Create Session</a></p>
                <p class="sidebar_selected" align="center">Current Session</p>
                <p class="sidebar" align="center"><a href="/addNominators">Add Nominators</a></p>
            </div>

            <div class="CENTER">
                <p class="Form" align="left">
                    Current Session
                </p>

                <p class="information">

                    <?php

                    if ( is_null($session) )
                    {
                        echo 'There is no session that is currently open.';
                    }
                    else
                    {
                        echo '
                        
                        
                        <table>
                            <tr>
                                <td>Semester and Year: </td>
                                <td>'.$session->id.'</td>
                            </tr>
                            <tr>
                                <td>Nomination Deadline: </td>
                                <td>'.$session->nominationDeadline.'</td>
                            </tr>
                            <tr>
                                <td>Response Deadline: </td>
                                <td>'.$session->responseDeadline.'</td>
                            </tr>
                            <tr>
                                <td>Verification Deadline: </td>
                                <td>'.$session->verificationDeadline.'</td>
                            </tr>
                        </table>
                        <br><br>
    
                        <b>GC Chair</b> <br><br>
                        <table>
                            <tr>
                                <td>Username: </td>
                                <td>'.$session->gcChair->getUsername().'</td>
                            </tr>
                            <tr>
                                <td>First Name: </td>
                                <td>'.$session->gcChair->getFirstName().'</td>
                            </tr>
                            <tr>
                                <td>Last Name: </td>
                                <td>'.$session->gcChair->getLastName().'</td>
                            </tr>
                            <tr>
                                <td>Email Address: </td>
                                <td>'.$session->gcChair->getEmail().'</td>
                            </tr>
                        </table>
                        <br><br>
    
                        <b>GC Members<b><br><br>
                        <table class="neatTable">
                            <tr>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                            </tr>';

                        foreach ($session->gcUsersList as $gcUser )
                        {
                            echo '<tr>' .
                                      '<td>' . $gcUser->getUsername() . '</td>' .
                                      '<td>' . $gcUser->getFirstName() . '</td>' .
                                      '<td>' . $gcUser->getLastName() . '</td>' .
                                      '<td>' . $gcUser->getEmail() . '</td>' .
                                 '</tr>';
                        }

                        echo '
                        </table>';
                    }
                    ?>
                <br><br>
            </div>


            <!-- end center div -->
        </div>
    </body>
</html>
