<?php
    include "mars-session.php";
?>
<!-- page allows users to update some of their details -->
<!doctype html>
<html>
    <head>
        <title>Mars Pioneer: Application System</title>
        <meta name="description" content="Mars Pioneer: Application System, portfolio of work">
        <meta name="keywords" content="Mars Pioneer EFREI">
        <meta name="author" content="H.Scott">
        <link rel="stylesheet" type="text/css" href="mars.css" media="screen">
        <link rel="icon" type="image/ico" href="favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
    </head>

    <body>
        <div id="container">
            <header><a href="mars.htm">Mars Pioneer: Update Application</a>
            </header>

            <div id="main">
                <section>
                    <?php
                        //DB connection and retrieval of user details
//                        session_start();
                        $username = $_SESSION['username'];

                        $dbname = "mars";
                        $dbusername = "root";
                        $dbpassword = "";

                        $mysqli = new mysqli('localhost', $dbusername, $dbpassword, $dbname);
                        if ($mysqli->connect_errno)
                        {   print("<br>Connect failed: " . $mysqli->connect_error);
                            exit();
                        }

                        $sSQL = "SELECT * FROM user WHERE email = '$username'";

                        $rsMain = $mysqli->query( $sSQL );
                        while($row = $rsMain->fetch_assoc()){
                            $sForename = $row["forename"];
                            $sSurname = $row["surname"];
                            $sEmail = $row["email"];
                        }
                    ?>
                    <style>
                        #forms div {
                            display: inline;
                            margin: 0 1em 0 1em;
                            width: 30%;
                        }
                    </style>
                    
                    <div style="float:left" id="forms">
                        <!-- Display of details and form to allow changing of name and email -->
                        <p><label> Name: <?php echo $sForename ?> <?php echo $sSurname ?> </label></p>
                        <p><label> Email: <?php echo $sEmail ?> </label></p>
                        
                        <div style="float:left">
                            <form action="mars-updatename.php" method="post" >
                                <label>Change your Details: </label>
                                <p><input type="text" value="" name="updateforename" placeholder="New Forename"></p>
                                <p><input type="text" value="" name="updatesurname" placeholder="New Surname"></p>
                                <p><input type="text" value="" name="updateemail" placeholder="New Email"></p>
                                <p><input type="submit" name="submit" value="Change Details"/></p>
                            </form>
                        </div>
                        
                        <!-- form to allow the change of user password -->
                        <div style="float:right">
                            <form action="mars-updatepassword.php" method="post">
                                <label>Change Password: </label>
                                <p><input type="password" value="" name="currentpassword" placeholder="Current Password" ></p>
                                <p><input type="password" value="" name="newpassword" placeholder="New Password" ></p>
                                <p><input type="password" value="" name="newpassword2" placeholder="Repeat Password" ></p>
                                <p><input type="submit" name="submit" value="Change Password"/></p>
                            </form>                       
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <footer>
            Disclaimer: Space travel may be extremely hazardous to your health.
        </footer>
    </body>
</html>