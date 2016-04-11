<?php

session_start();

//check role of user
if($_SESSION['role'] != 3)
{
    //if logged in user is a GC member
    if ($_SESSION['role'] == 2)
    {
        //redirect to GC view
        header("Location: /gcHome");
    } // If logged in as admin
    else if ($_SESSION['role'] == 1)
    {
        header("Location: /adminHome");
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
    <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
    <title>Add Nominees</title>
</head>

<body>

<div class="WRAPPER">
    <div class="TOP" align="right">
        <!-- should be variable, but then again, there's only one admin account... -->
        <?php echo 'Signed in as ' . $_SESSION['username'] . ' (nominator)'; ?><br>
        <a href="/logout">Sign out</a>
    </div>

    <div class="LEFT">
        <p class="sidebar" align="center"><a href="/nominatorHome">Home</a></p>
        <p class="sidebar_selected" align="center"><b>Add Nominees</b></p>
    </div>

    <div class="CENTER">
    <!--
        get username from session variable
        get session from query
        in email use pid to create url
            - /nomineeApplication?id={PID}
     -->
     <p class="addNomineeForm" align="left">
         Add Nominees

        <form action="/nominatorCtrl" method="post">

        <p class="information">
            <?php
            echo $_SESSION['message'];
            $_SESSION['message'] = '';
            ?>
        </p>

        <div id="dynamicInput">
            <label for="fname">First Name: </label>
            <input type="text" name="fname[0]" placeholder="Nominee's First Name" id="fname">
            <label for="lname">Last Name: </label>
            <input type="text" name="lname[0]" placeholder="Nominee's Last Name" id="lname">
            <label for="pid">PID: </label>
            <input type="text" name="pid[0]" placeholder="Nominee's PID" id="pid">
            <label for="email">Email: </label>
            <input type="text" name="email[0]" placeholder="Nominee's Email" id="email"><br>
            <label for="rank">Rank Nominee: </label>
            <input type="number" name="rank[0]" placeholder="Rank" min="0" max="100" id="rank">

            CS Graduate:
            <select name="csgrad[0]">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            New Graduate:
            <select name="newgrad[0]">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <input type="button" value="Remove" name="remove[0]" onclick="removeFirst('dynamicInput');">
            <br><br>
        </div>

        <div id="extraInputs">
        </div>

        <br>

        <!-- button for adding values dynamically -->
        <input type="button" value="Add Another Nominee" onClick="addInputAddNominee('extraInputs');">

        <!-- Tells the controller which function to call -->
        <input type="hidden" name="createNominationForms">
        <!-- Increment after each dynamically added nominator form -->
        <input type="hidden" name="NomCount" value="1" id="count">



        <p class="submit" align="center">
            <input type="submit" value="Create">
        </p>


        </form>
        </p>

        <p class="addNomineeForgotten">
        <!-- leave this -->
        </p>
    </p>
    </div> <!-- end center div -->
</div>

<!--javascript-->
<script src="public/js/addInputAddNominees.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
