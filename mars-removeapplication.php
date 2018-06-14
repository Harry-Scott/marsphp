<?php
//removes the user deatils from the DB if their entered password and email are correct and match, and also from the logged in user, cannot remove other user's details.

session_start();
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
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

if($email == $username){
    if(password_verify($password, $oldpassword)){
        $sRemove = "DELETE FROM user WHERE email = '$username'";
        $rsMain = $mysqli->query( $sRemove );
    }
}
header ("location: mars.htm");

?>