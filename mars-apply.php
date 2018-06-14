<!doctype html>
<!-- page to enter user detials into the DB and display them back to the user upon entry. -->
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
        <header><a href="mars.htm">Mars Pioneer: Apply</a></header>
    <div id="main">

    <section>
    <?php        
        //Pulls user's entered details from the form
        $apforename = $_REQUEST['applicantforename'];
        $apsurname = $_REQUEST['applicantsurname'];
        $apemail = $_REQUEST['applicantemail'];
        $apcountry = $_REQUEST['applicantcountry'];
        $apskill1 = $_REQUEST['primaryskill'];
        $apskill2 = $_REQUEST['secondaryskill'];
        $apskill3 = $_REQUEST['tertiaryskill'];
        $appassword = $_REQUEST['applicantpassword'];
        
        //Hashes the entered password
        $encryptedPassword = password_hash($appassword, PASSWORD_DEFAULT);
        
        //Database connection
        $dbname = "mars";
        $dbusername = "root";
        $dbpassword = "";
        
        $mysqli = new mysqli('localhost', $dbusername, $dbpassword, $dbname);
        if ($mysqli->connect_errno)
        {   print("<br>Connect failed: " . $mysqli->connect_error);
            exit();
        }
        
        //Query to compare email to those in the database. If the email is already in the database the application is terminated.
        $sqlmail = "SELECT * FROM `user` WHERE (`user`.`email` = '$apemail');";
        $rsMain = $mysqli->query( $sqlmail );
        
        if (mysqli_num_rows($rsMain) > 0) {
            $row = mysqli_fetch_assoc($res);
            if($email == $row['email']) {
                header ("location: mars.htm");
                print("<br>This email is already taken");
                $mysli->close();
            }
        }
        
        //performs the insertion of the details into the database using a prepared statement
        $stmt = $mysqli->prepare("INSERT INTO `mars`.`user` (`id`, `forename`, `surname`, `email`, `password`, `country`, `skill1`, `skill2`, `skill3`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssiiii", $id, $apforename, $apsurname, $apemail, $password, $apcountry, $apskill1, $apskill2, $apskill3);
        $id = NULL;
        $apforename = $_REQUEST['applicantforename'];
        $apsurname = $_REQUEST['applicantsurname'];
        $apemail = $_REQUEST['applicantemail'];
        $apcountry = $_REQUEST['applicantcountry'];
        $apskill1 = $_REQUEST['primaryskill'];
        $apskill2 = $_REQUEST['secondaryskill'];
        $apskill3 = $_REQUEST['tertiaryskill'];
        $password = $encryptedPassword;
        $stmt->execute();
        $stmt->close();
        
        //Query to find country name from ID
        $sqlcountry = "SELECT `countryName` FROM `country` WHERE `id` = $apcountry";
        $rsMain = $mysqli->query( $sqlcountry );
        
        while($row = $rsMain->fetch_assoc()){
            $sCountry = $row["countryName"];
        }
        
        //Query to find skill 1 from database
        $sqlskills = "SELECT `skillName` FROM `skills` WHERE `id` = $apskill1";
        $rsMain = $mysqli->query( $sqlskills );        
        while($row = $rsMain->fetch_assoc()){ $sSkill1 = $row["skillName"]; }
        
        //Query to find skill 2 from database
        $sqlskills = "SELECT `skillName` FROM `skills` WHERE `id` = $apskill2";
        $rsMain = $mysqli->query( $sqlskills );
        while($row = $rsMain->fetch_assoc()){ $sSkill2 = $row["skillName"]; }
        
        //Query to find skill 3 from database
        $sqlskills = "SELECT `skillName` FROM `skills` WHERE `id` = $apskill3";
        $rsMain = $mysqli->query( $sqlskills );
        while($row = $rsMain->fetch_assoc()){ $sSkill3 = $row["skillName"]; }
        
        //session start
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $apemail;
    ?>
        
    <p>Your details: </p>
    <p>Name: <?php echo $apforename; ?> <?php echo $apsurname; ?> </p>
    <p>Email: <?php echo $apemail; ?></p>
    <p>Country: <?php echo $sCountry; ?> </p>
    <p>Primary Skill: <?php echo $sSkill1; ?> </p>
    <p>Secondary Skill: <?php echo $sSkill2; ?> </p>
    <p>Tertiary Skill: <?php echo $sSkill3; ?> </p>
    <a id="returnbutton" href="mars.htm">Return to Home</a>

    </section>
    </div>
</div>
<footer>
    Disclaimer: Space travel may be extremely hazardous to your health.
</footer>
</body>
</html>