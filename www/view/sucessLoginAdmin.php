<html>
<head>
<link href="public/stylesheets/sucessLoginAdmin.css" type="text/css" rel="stylesheet" >
<title>GTASS</title>
</head>

<body>
<p class="header" align="right">
<!-- should be variable, but then again, there's only one admin account... -->
  Signed in as Admin<br>
    <a href="/~alex/GTASS/view/index.php">Sign out</a>
</p>

<div class="CENTER">
<p class="Form" align="left">
  Form Creation
  <form action="" method="POST">
  <p class="semester_year">
    semester:
    <select>
        <option value="Fall">Fall</option>
        <option value="Spring">Spring</option>
        <option value="Summer">Summer</option>
    </select>
    <br><br>
    year:
     <select>
        <option value="2010">2010</option>
        <option value="2011">2011</option>
        <option value="2012">2012</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
    </select>
    <br><br>
    date: {insert jquery datepicker}
    <p class="submit" align="left">
      <input type="submit" value="Create">
    </p>
  </p>
  </form>
  <p class="forgotten">
    <!-- leave this -->
  </p>
</p>
</div>

</body>
</html>
