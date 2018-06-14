<?php
    //php to login user 
    $dbname = "mars";
    $dbusername = "root";
    $dbpassword = "";

    $mysqli = new mysqli('localhost', $dbusername, $dbpassword, $dbname);
    if ($mysqli->connect_errno)
    {   print("<br>Connect failed: " . $mysqli->connect_error);
        exit();
    }

    $sEmail = $_REQUEST['usr'];
    $sPassword = $_REQUEST['pwd'];

    //Verify password. Compare the hashed version of the entered password and the hashed password from the DB.
    $sSQL = "SELECT `password`, `email` FROM `user` WHERE `email`='$sEmail'";

    $rsMain = $mysqli->query( $sSQL );
    while($row = $rsMain->fetch_assoc()){   
        $sSQL = $row["password"];
        $username = $row["email"];
    }

    //if passwords are the same then start a session and set username session variable to entered username and loggedIn to true, allowing them to access paged blocked behind login. Otherwise redirect to homepage.
    if(password_verify($sPassword, $sSQL)){
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;
        header("location: mars.htm");
    } else {
        header("location: mars.htm");
    }

    $rsMain = null;
    $mysqli->close();
?>