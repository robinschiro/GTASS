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
    <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet">
    <title>Admin Form</title>

</head>

<body>

<div class="WRAPPER">

    <div class="TOP" align="right">
        <?php echo 'Signed in as ' . $_SESSION['username'] . ' (admin)'; ?><br>
        <a href="/logout">Sign out</a>
    </div>

    <div class="LEFT">
        <p class="sidebar_selected" align="center">Home</p>
        <p class="sidebar" align="center"><a href="/createSession">Create Session</a></p>
        <p class="sidebar" align="center"><a href="/currentSession">Current Session</a></p>
        <p class="sidebar" align="center"><a href="/addNominators">Add Nominators</a></p>
    </div>

    <div class="CENTER">
        <p class="Form" align="left">
            Hello, Administrator
        <p class="information">
            What to add here? Lorem ipsum dolor sit amet.
        </p>

        <p class="forgotten">
            <!-- leave this -->
        </p>
        </p>
    </div> <!-- end center div -->
</div>

</body>
</html>
