<!-- This file checks the login data of each user and redirects accordingly -->
<?php
    
    try
    {
        // trying to get the username and password entered
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Checking whether user record exists or not
        require 'includes/db-conn.php';
        $sql = 'SELECT * FROM users WHERE username = :username';
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
        $cmd->execute();
        $user= $cmd->fetch();
        $db= null;
    
        
        if(!empty($user))
        {
        //  Checking whether the hashed password matches or not
            if(password_verify($password, $user['password']))
            {
                session_start();
                $_SESSION['username'] = $username;
                header("location:dashboard.php");
            }
    
            else{
                // Password does not match so we redirect them to the login  page with invalid parameter
                header("location:login.php?invalid=true");
            }
        }
        else{
            // invalid username redirecting to login page
            header("location:login.php?invalid=true");
        }
    }
    catch(Exception $error)
    {
        header("location:error.php");
    }



?>