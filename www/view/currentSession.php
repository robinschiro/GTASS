<html>
    <head>
        <link href="public/stylesheets/sucessLoginAdmin.css" type="text/css" rel="stylesheet" >
        <title>GTASS</title>
    </head>

    <body>
        <div class="WRAPPER" >
            <div class="TOP" align="right">
            <!-- should be variable, but then again, there's only one admin account... -->
                <?php echo 'Signed in as '.$_SESSION['username'].' (admin)';?><br>
                <a href="/logout">Sign out</a>
            </div>

            <div class="LEFT">
                <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Home</a></p>
                <p class="sidebar" align="center"><a href="/admin">Session Creation</a></p>
                <p class="sidebar_selected" align="center"><b>Current Session</b></p>
                <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Ipsum</a></p>
                <p class="sidebar" align="center"><a href="www.google.comORSOMETHING">Dolor</a></p>
            </div>

            <div class="CENTER">
                <p class="Form" align="left">
                    Current Session
                </p>

                <!-- Display a table with the session details -->
                <div>
                    <?php
                    print_r($session);
                    ?>
                </div>
            </div>


            <!-- end center div -->
        </div>
    </body>
</html>
