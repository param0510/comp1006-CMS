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