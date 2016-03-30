<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="public/stylesheets/index.css" type="text/css" rel="stylesheet">
    <title>GTASS Login</title>
</head>

<body>
<p class="header" align="left">
    GTASS - Graduate Teaching Assistant Selection System
</p>

<div class="CENTER">
    <p class="login">
        User Login
    </p>
    <form action="/login" method="POST">
        <div class="inputBoxBorders">
            username: <input id="username" type="text" name="username" class="textBoxes" required="required">
            <br><br>
            password: <input id="password" type="password" name="password" class="textBoxes2" required="required">
            <br><br>
            <input type="submit" value="Login">
        </div>
        <input type="hidden" name="login">
        <!--    <p class="submit" align="center">-->


        <!--    </p>-->
    </form>
    <p class="forgotten">
        <!-- leave this -->
    </p>
    </p>
</div>

</body>
</html>
