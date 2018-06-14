<?php
    include "mars-session.php";
?>
<!-- page to show the applications of all created user applications. Cannot be accessed by non logged in users as includes mars-session.php -->
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
            <header><a href="mars.htm">Mars Pioneer: Show Applications</a>
            </header>

            <div id="main" style="height:86%; width:90%; overflow:auto">
                <section>                    
                <?php
                    //DB connection and retrieval of user data.
                    $dbname = "mars";
                    $dbusername = "root";
                    $dbpassword = "";

                    $mysqli = new mysqli('localhost', $dbusername, $dbpassword, $dbname);
                    if ($mysqli->connect_errno)
                    {   print("<br>Connect failed: " . $mysqli->connect_error);
                        exit();
                    }
                    
                    $sSQL = "SELECT forename, surname, email, s1.skillName AS 'skill1', s2.skillName AS 'skill2', s3.skillName AS 'skill3', c1.countryName AS 'country' 
                        FROM user 
                        INNER JOIN skills AS s1 ON s1.id = user.skill1 
                        INNER JOIN skills AS s2 ON s2.id = user.skill2 
                        INNER JOIN skills AS s3 ON s3.id = user.skill3 
                        INNER JOIN country AS c1 ON c1.id = user.country 
                        ORDER BY user.id ASC";
                        
                    $rsMain = $mysqli->query( $sSQL );
                    
                    //displaying of data in a table
                    echo "<table>\n";
                    while($row = $rsMain->fetch_assoc()){
                        $sFName = $row["forename"];
                        $sSName = $row["surname"];
                        $sEmail = $row["email"];
                        $sCountry = $row["country"];
                        $sPrimary = $row["skill1"];
                        $sSecondary = $row["skill2"];
                        $sThird = $row["skill3"];
                        
                        echo "<tr>\n";
                        print "\t<td>$sFName</td>\n";
                        print "\t<td>$sSName</td>\n";
                        print "\t<td>$sEmail</td>\n";
                        print "\t<td>$sCountry</td>\n";
                        print "\t<td>$sPrimary</td>\n";
                        print "\t<td>$sSecondary</td>\n";
                        print "\t<td>$sThird</td>\n";
                        echo "</tr>\n";
                    }
                    echo "</table>";                    
                ?>                    
                </section>
            </div>
        </div>
        <footer>
            Disclaimer: Space travel may be extremely hazardous to your health.
        </footer>
    </body>
</html>