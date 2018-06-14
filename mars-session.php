<?php
//The session is started when called, if there is a logged in user then the session may proceed, otherwise the users is redirected back to the homepage mars.htm.
	session_start();
    
    if (!isset($_SESSION['loggedIn'])) {
        header("location: mars.htm");
        exit(0);
    }
?>