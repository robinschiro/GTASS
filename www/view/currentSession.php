<!-- This view is rendered by the adminController. The $session variable must be initialized before
     rendering this view -->
<html>
    <head>
        <link href="public/stylesheets/sucessLoginAdmin.css" type="text/css" rel="stylesheet" >
        <title>GTASS</title>
    </head>

    <body>
        <div class="WRAPPER" >
            <div class="TOP" align="right">
                <?php echo 'Signed in as '.$_SESSION['username'].' (admin)';?><br>
                <a href="/logout">Sign out</a>
            </div>

            <div class="LEFT">
                <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Home</a></p>
                <p class="sidebar" align="center"><a href="/admin">Session Creation</a></p>
                <p class="sidebar_selected" align="center"><b>Current Session</b></p>
                <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Ipsum</a></p>
                <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Dolor</a></p>
            </div>

            <div class="CENTER">
                <p class="Form" align="left">
                    Current Session
                </p>

                <p class="semester_year">
                    Semester and Year: <?php echo $session->id  ?>
                    <br><br>

                    <!-- Deadlines -->
                    <table>
                        <tr>
                            <td>Nomination Deadline: </td>
                            <td><?php echo $session->nominationDeadline ?></td>
                        </tr>
                        <tr>
                            <td>Response Deadline: </td>
                            <td><?php echo $session->responseDeadline ?></td>
                        </tr>
                        <tr>
                            <td>Verification Deadline: </td>
                            <td><?php echo $session->verificationDeadline ?></td>
                        </tr>
                    </table>
                    <br><br>

                    <b>GC Chair</b> <br><br>
                    <table>
                        <tr>
                            <td>Username: </td>
                            <td><?php echo $session->gcChair->getUsername() ?></td>
                        </tr>
                        <tr>
                            <td>First Name: </td>
                            <td><?php echo $session->gcChair->getFirstName() ?></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><?php echo $session->gcChair->getLastName() ?></td>
                        </tr>
                        <tr>
                            <td>Email Address: </td>
                            <td><?php echo $session->gcChair->getEmail() ?></td>
                        </tr>
                    </table>
                    <br><br>

                <b>GC Members</b> <br><br>
                <table border="1" cellpadding="5" cellspacing="5">
                    <tr>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                    </tr>
                    <?php
                        foreach ($session->gcUsersList as $gcUser )
                        {
                            echo '<tr>' .
                                      '<td>' . $gcUser->getUsername() . '</td>' .
                                      '<td>' . $gcUser->getFirstName() . '</td>' .
                                      '<td>' . $gcUser->getLastName() . '</td>' .
                                      '<td>' . $gcUser->getEmail() . '</td>' .
                                 '</tr>';
                        }
                    ?>

                </table>
                <br><br>
            </div>


            <!-- end center div -->
        </div>
    </body>
</html>
