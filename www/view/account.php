<!-- This view is rendered by the accountController. -->

<?php
require_once('../controller/accountController.php');
$accountCtrl = new accountController();
$currentUser = $accountCtrl->getCurrentUser();
?>


<html>
<head>
    <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
    <title>GTASS</title>
</head>

    <body>
    <div class="WRAPPER" >
        <div class="TOP" align="right">
            <?php echo 'Signed in as '.$_SESSION['username'];?><br>
            <a href="/logout">Sign out</a>
        </div>

        <div class="LEFT">
            <p class="sidebar" align="center"><a href="/nominator/nominatorHome">Home</a></p>
            <p class="sidebar_selected" align="center">My Account</p>
            <p class="sidebar" align="center"><a href="/nominator/addNominees">Add Nominees</a></p>
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
                            <td><input type="text" value=<?php echo $currentUser->getUsername(); ?> name="username"/></td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" placeholder="Enter new password" name="password"/></td>
                            <td> (leave blank to keep password unchanged) </td>
                        </tr>
                        <tr>
                            <td>First Name: </td>
                            <td><input type="text" value=<?php echo $currentUser->getFirstName(); ?> name="firstName"/></td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td><input type="text" value=<?php echo $currentUser->getLastName(); ?> name="lastName"/></td>
                        </tr>
                        <tr>
                            <td>Email Address: </td>
                            <td><input type="text" value=<?php echo $currentUser->getEmail(); ?> name="emailAddress"/></td>
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
