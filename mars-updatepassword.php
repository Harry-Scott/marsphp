<?php
//php to facilitate the changing of password by a user
session_start();
$enteredpassword = $_REQUEST['currentpassword'];
$newpassword = $_REQUEST['newpassword'];
$newpassword2 = $_REQUEST['newpassword2'];

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

//Get the old hashed password from the DB
$sSQL = "SELECT password FROM user WHERE email = '$username'";
$rsMain = $mysqli->query( $sSQL );
while($row = $rsMain->fetch_assoc()){
    $oldpassword = $row["password"];
}

//if the hashed current entered password is the same as hashed password from the DB, and the new passwords are identical then update the DB with the new password
if(password_verify($enteredpassword, $oldpassword)){

    if($newpassword == $newpassword2){
        $encryptednewpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $sUpdate = "UPDATE user SET password = '$encryptednewpassword' WHERE `email` = '$username'";
        $rsMain = $mysqli->query( $sUpdate );
    }

}

header ("location: mars.htm");

?>
