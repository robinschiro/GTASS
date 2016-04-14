<?php

session_start();

//check role of user
if($_SESSION['role'] != 3)
{
    //if logged in user is a GC member
    if ($_SESSION['role'] == 2)
    {
        //redirect to GC view
        header("Location: /gc/gcHome");
    } // If logged in as admin
    else if ($_SESSION['role'] == 1)
    {
        header("Location: /admin/currentSession");
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
    <link href="../public/stylesheets/common.css" type="text/css" rel="stylesheet" >
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
        <p class="sidebar" align="center"><a href="/account">My Account</a></p>
        <p class="sidebar_selected" align="center">Add Nominees</p>
    </div>

    <div class="CENTER">

     <p class="Form" align="left">
         Add Nominees

        <form action="/nominatorCtrl" method="post" onsubmit="return validateForms();">

        <p class="information">
            <?php
            echo $_SESSION['message'];
            $_SESSION['message'] = '';
            ?>
        </p>

        <div id="dynamicInput">
            First Name:
            <input type="text" id="requi" name="fname[0]" placeholder="Nominee's First Name" id="fname">
            Last Name:
            <input type="text" id="requi" name="lname[0]" placeholder="Nominee's Last Name" id="lname">
            PID:
            <input type="text" id="requi" name="pid[0]" placeholder="Nominee's PID" id="pid">
            Email:
            <input type="text" id="requi" name="email[0]" placeholder="Nominee's Email" id="email"><br>
            Nominee's Rank:
            <input type="number" id="requi" name="rank[0]" placeholder="Rank" min="0" id="rank">

            CS Graduate:
            <select name="csgrad[0]">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            New Graduate:
            <select name="newgrad[0]">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

            <input type="button" value="Remove" name="remove[0]" onclick="removeFirst('dynamicInput');">
            <br><br>
        </div>

        <div id="extraInputs">
        </div>

        <!-- button for adding values dynamically -->
        <input type="button" value="Add Another Nominee" onClick="addInput('extraInputs');"><br><br>

        <br><br>

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
<script src="../public/js/addInputAddNominees.js" language="Javascript" type="text/javascript"></script>
<script src="../public/js/InputValidation.js" language="Javascript" type="text/javascript"></script>

</body>
</html>
