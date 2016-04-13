<?php

session_start();

//check role of user
if($_SESSION['role'] != 1)
{
    //if logged in user is a GC member
    if ($_SESSION['role'] == 2)
    {
        //redirect to GC view
        header("Location: /gc/gcHome");
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

<html>
<head>
    <link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet">
    <title>Add Nominators</title>
</head>

<body>
<div class="WRAPPER" >
    <div class="TOP" align="right">
        <!-- should be variable, but then again, there's only one admin account... -->
        <?php echo 'Signed in as '.$_SESSION['username'].' (admin)';?><br>
        <a href="/logout">Sign out</a>
    </div>

    <div class="LEFT">
        <p class="sidebar" align="center"><a href="/account">My Account</a></p>
        <p class="sidebar" align="center"><a href="/admin/createSession">Create Session</a></p>
        <p class="sidebar" align="center"><a href="/admin/currentSession">Current Session</a></p>
        <p class="sidebar_selected" align="center">Add Nominators</p>
        <p class="sidebar" align="center"><a href="/admin/allSessions">View All Sessions</a></p>
    </div>

    <div class="CENTER">
        <p class="Form" align="left">
            Add Nominators
        <form action="/adminCtrl" method="POST">

            <p class="information">
                <?php
                    echo $_SESSION['message'];
                    $_SESSION['message'] = '';
                ?>
            </p>

            <div id="dynamicInput">
                <!--dynamically adding new fields-->
                Nominator: <input type="text" placeholder="username" name="uname[0]">
                <input type="password" placeholder="password" name="password[0]">
                <input type="text" placeholder="first name" name="firstname[0]">
                <input type="text" placeholder="last name" name="lastname[0]">
                <input type="text" placeholder="email" name="email[0]">
                <input type="button" value="Remove" name="remove[0]" onclick="removeFirst('dynamicInput');">
                <br><br>
            </div>

            <div id="extraInputs">
            </div>

            <input type="button" value="Add Another Nominator" onClick="addInput('extraInputs');"><br><br>

            <br><br>

            <p class="submit" align="center">
                <input type="submit" value="Create">
            </p>

            <!-- This hidden field is used as a POST variable to inform the admin controller
                 that a session needs to be created. -->
            <input type="hidden" name="createNominators">

            <!-- Initially 1 will be incremented each time a new gc member is added -->
            <input type="hidden" name="count" value="1" id="gcCount">

        </form>

        <p class="forgotten">
            <!-- leave this -->
        </p>
    </p> <!-- end class="Form" paragraph -->
    </div>
</div>

<!--javascript-->
<script src="../public/js/addInputAddNominators.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
