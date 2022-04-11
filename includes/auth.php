<!-- Authorization file  -->
<!-- This checks whether user is logged in or not -->
<!-- It is used to make pages private -->
<?php

if(session_status() == PHP_SESSION_NONE )
{
    session_start();
}

if(empty($_SESSION['username']))
{
    header("location:login.php");
    exit();
}
?>