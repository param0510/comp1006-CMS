<?php
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    require 'includes/db-conn.php';
    $sql = 'SELECT * FROM users WHERE username = :username';
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
    $cmd->execute();
    $user= $cmd->fetch();
    $db= null;

    
    if(!empty($user))
    {
     
        if(password_verify($password, $user['password']))
        {
            session_start();
            $_SESSION['username'] = $username;
            header("location:dashboard.php");
        }

        else{
            // Password does not match so we redirect them to the login  page
            header("location:login.php?invalid=true");
        }
    }
    else{
        // invalid username
        header("location:login.php?invalid=true");
    }



?>