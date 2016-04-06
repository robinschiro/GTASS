<html>
    <head>
        <link href="public/stylesheets/common.css" type="text/css" rel="stylesheet" >

    </head>
    <body>

        <table class="userList">
            <tr>
                <th>Nominator Name</th>
                <th>Nominee Name</th>
                <th>Rank</th>
                <th>Is New</th>

                <?php
                    // The current session should be stored in $session at this point.
                    $gcMembers = $session->getGcUsersList();
                    array_push($gcMembers, $session->getGcChair());

                    foreach( $gcMembers as $gcMember )
                    {
                        echo '<th>' . $gcMember->getLastName() . '</th>';
                    }
                ?>
                <th>Average Score</th>


            </tr>

        </table>
        

    </body>
</html>
