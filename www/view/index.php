<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="../public/stylesheets/index.css" type="text/css" rel="stylesheet">
    <title>GTASS Login</title>
</head>

<body>
<p class="header" align="left">
    GTASS - Graduate Teaching Assistant Selection System
</p>

<div class="TOP" align="center">
    <image src="public/images/UCF_horizontal_logo.png" width="35%" height="18%"/>
</div>

<div class="CENTER">
    <p class="login">
        User Login
    </p>

    <?php
    if ( isset($_GET['goToApproval']) )
    {
        $GETVariableString = '?approveNominee=&pid='.$_GET['pid'].'&sessionID='.$_GET['sessionID'];
    }
    ?>

    <form <?php echo 'action="/login'.$GETVariableString.'"'; ?> method="POST">
        <div class="inputBoxBorders">
            Username: <input id="username" type="text" name="username" class="textBoxes" required="required">
            <br><br>
            Password: <input id="password" type="password" name="password" class="textBoxes2" required="required">
            <br><br>
            <input type="submit" value="Login">
        </div>
        <input type="hidden" name="login">
        <!--    <p class="submit" align="center">-->

        <?php
            if ( isset($_GET['goToAccount']) )
            {
                echo '<input type="hidden" name="goToAccount">';
            }
        ?>

        <!--    </p>-->
    </form>
    <p class="forgotten">
        <!-- leave this -->
    </p>
    </p>
</div>

</body>
</html>
