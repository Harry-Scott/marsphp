<?php
//php to facilitate the changing of the users name
    session_start();
    $forename = $_REQUEST['updateforename'];
    $surname = $_REQUEST['updatesurname'];
    $email = $_REQUEST['updateemail'];

    $username = $_SESSION['username'];

    //DB connection
    $dbname = "mars";
    $dbusername = "root";
    $dbpassword = "";

    $mysqli = new mysqli('localhost', $dbusername, $dbpassword, $dbname);
    if ($mysqli->connect_errno)
    {   print("<br>Connect failed: " . $mysqli->connect_error);
        exit();
    }

    //selects the user details from their email
    $sqlmail = "SELECT * FROM `user` WHERE (`user`.`email` = '$email');";
    $rsMain = $mysqli->query( $sqlmail );
    while($row = $rsMain->fetch_assoc()){
        $sEmail = $row["email"];
    }
    //if there is a user with the entered email and it isnt the logged in user then exit
    if(mysqli_num_rows($rsMain) > 0 && $sEmail != $username){
        header ("location: mars.htm");
        print("<br>This email is already taken");
        $mysli->close();
    }

    //scripts to update the datasebase based on if each field had somethign entered into them
    if(isset($forename)){
        $updateSQL = "UPDATE user SET forename = '$forename' WHERE `email` = '$username'";
    }

    if(isset($surname)){
        $updateSQL2 = "UPDATE user SET surname = '$surname' WHERE `email` = '$username'";
    }

    if(isset($surname)){
        $updateSQL3 = "UPDATE user SET email = '$email' WHERE `email` = '$username'";
    }

    $rsMain = $mysqli->query( $updateSQL );
    $rsMain = $mysqli->query( $updateSQL2 );
    $rsMain = $mysqli->query( $updateSQL3 );

    if(isset($email)){
        $_SESSION['username'] = $email;
    }

    header("location:mars.htm");
?>