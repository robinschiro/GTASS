<?php

session_start();

//check role of user
if ($_SESSION['role'] != 1) {
    //if logged in user is a GC member
    if ($_SESSION['role'] == 2) {
        //redirect to GC view
        header("Location: /gcHome");
    } // If logged in as nominator
    else if ($_SESSION['role'] == 3) {
        header("Location: /addNominees");
    } //Session variable role not recognized as valid
    else {
        //user must resign in
        header("Location: /");
    }
}
?>

<?php
require_once('../controller/adminController.php');
$adminCtrl = new adminController();
$allSessions = $adminCtrl->sessionServ->getAllSessions();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>All Sessions</title>
    <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet">
</head>

<body>
<?php
foreach ($allSessions as $session) {
    ?>
    <div class="CENTER">
        <p class="Form" align="left">
            Current Session
        </p>

        <p class="information">
        <table>
            <tr>
                <td>Semester and Year:</td>
                <td><?php echo $session->id ?></td>
            </tr>
            <tr>
                <td>Nomination Deadline:</td>
                <td><?php echo $session->nominationDeadline ?></td>
            </tr>
            <tr>
                <td>Response Deadline:</td>
                <td><?php echo $session->responseDeadline ?></td>
            </tr>
            <tr>
                <td>Verification Deadline:</td>
                <td><?php echo $session->verificationDeadline ?></td>
            </tr>
        </table>

        <br><br>

        <b>GC Chair</b> <br><br>
        <table>
            <tr>
                <td>Username:</td>
                <td><?php echo $session->gcChair->getUsername() ?></td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td><?php echo $session->gcChair->getFirstName() ?></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><?php echo $session->gcChair->getLastName() ?></td>
            </tr>
            <tr>
                <td>Email Address:</td>
                <td><?php echo $session->gcChair->getEmail() ?></td>
            </tr>
        </table>
        <br><br>

        <b>GC Members</b> <br><br>
        <table class="userList">
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
            </tr>




            <?php

            // Iterate through each member and display the corresponding data.
            foreach ($session->gcUsersList as $gcUser) {
                echo '<tr>' .
                    '<td>' . $gcUser->getUsername() . '</td>' .
                    '<td>' . $gcUser->getFirstName() . '</td>' .
                    '<td>' . $gcUser->getLastName() . '</td>' .
                    '<td>' . $gcUser->getEmail() . '</td>' .
                    '</tr>';
            }
            ?>

        </table>

<!--        --><?php //echo '$session->gcUsersList length = ' . count($session->gcUsersList); ?>
        <br><br>
    </div>


    <?php
}
?>
</body>

</html>