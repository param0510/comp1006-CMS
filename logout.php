<!-- This is logout page which logs users out of the website and bring them back to the login page on public platform -->
<?php
        // Access the current session
        session_start();

        // clear session variables
        session_unset();

        // destroy session
        session_destroy();

        // redirect to login page
        header("location:login.php");
    
?>