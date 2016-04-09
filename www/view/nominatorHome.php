<html>
<head>
<link href="public/stylesheets/createSession.css" type="text/css" rel="stylesheet" >
<link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >
<title>Nominator Form</title>

</head>

<body>

<div class="WRAPPER" >

<div class="TOP" align="right">
    <?php echo 'Signed in as '.$_SESSION['username'].' (nominator)';?><br>
    <a href="/logout">Sign out</a>
</div>

<div class="LEFT">
    <p class="sidebar_selected" align="center">Home</p>
    <p class="sidebar" align="center"><a href="/addNominees">Add Nominees</a></p>
</div>

<!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED -->
<!-- FORM ACTION NEEDED --><!-- (Maybe)(NOTICE ME) --><!-- FORM ACTION NEEDED -->
<!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED --><!-- FORM ACTION NEEDED -->

<div class="CENTER">
<p class="Form" align="left">
  Hello, Nominator
  <form action="NEED ACTION!!!!!!(maybe)" method="POST">
      <p class="information">
        What to add here? Lorem ipsum dolor sit amet.
      </p>

      <!-- <p class="submit" align="center">
        <input type="submit" value="Submit">
      </p> -->

      <!-- This hidden field is used as a POST variable to inform the admin controller
           that a session needs to be created. -->
      <input type="hidden" name="createSession">

      <!-- Initially 1 will be incremented each time a new gc member is added -->
      <input type="hidden" name="gcCount" value="1" id="gcCount">

  </form>

  <p class="forgotten">
    <!-- leave this -->
  </p>
</p>
</div> <!-- end center div -->

</div>

</body>
</html>
