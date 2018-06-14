<?php
//logs out user by removing session variables then clsing the session and redirecting back to home page.
    session_start();
    unset($_SESSION['loggedIn']);
    unset($_SESSION['username']);
    session_destroy();
    header("location: mars.htm");
?>