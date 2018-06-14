<?php
    include "mars-session.php";
?>
<!-- mars-remove.php allows users to remove their application if they are logged in and re enter their email and password. -->
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
            <header><a href="mars.htm">Mars Pioneer: Remove Application</a>
            </header>

            <div id="main">
                <section>
                    <?php
                        //opens a DB conenction in order to retireve user information to display it for the user.
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
                    
                    <!-- Form that allows user to remove their application, information is retrieved by mars-removeapplication.php -->
                    <div>
                        <p><label>Remove your application</label></p>
                        <p><label> Name: <?php echo $sForename ?> <?php echo $sSurname ?> </label></p>
                        <p><label> Email: <?php echo $sEmail ?> </label></p>                        
                        
                        <form method="post" action="mars-removeapplication.php">
                            <p><input type="text" value="" name="email" placeholder="Email"></p>
                            <p><input type="password" value="" name="password" placeholder="Password"></p>
                            <p><input type="submit" name="submit" Value="Remove Application"></p>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <footer>
            Disclaimer: Space travel may be extremely hazardous to your health.
        </footer>
    </body>
</html>