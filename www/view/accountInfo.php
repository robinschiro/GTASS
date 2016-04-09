<!-- This view is rendered by the adminController. The $session variable must be initialized before
     rendering this view -->

<?php

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
            <p class="sidebar_selected" align="center">My Account</p>
        </div>

        <div class="CENTER">
            <p class="Form" align="left">
                My Account
            </p>



            <br><br>
        </div>


        <!-- end center div -->
    </div>
    </body>
</html>
