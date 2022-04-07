<?php
    $pageName = 'Saving registration...';
    require 'includes/header.php';
    // $username = '';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $flag = true;
    if(empty(trim($username)))
    {
    echo    '<div class="alert alert-warning" role="alert">
                Username is empty!!
            </div>';
            $flag = false;
    }
    if(empty(trim($password)))
    {
    echo    '<div class="alert alert-warning" role="alert">
                Password is empty!!
            </div>';
            $flag = false;
    }

    if($flag)
    {
        try
        {
            require 'includes/db-conn.php';
            $sql = 'SELECT * FROM users WHERE username = :username';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
            $cmd->execute();
            $user = $cmd->fetch();
            if($user)
            {
                echo    '<div class="alert alert-warning" role="alert">
                            Username already exists!!
                        </div>';
                        $db = null;
            }
            else
            {
                $sql = "INSERT INTO users(username, password) 
                                VALUES (:username, :password)";

                $password = password_hash($password, PASSWORD_DEFAULT);

                $cmd = $db->prepare($sql);
                $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
                $cmd->bindParam(':password', $password, PDO::PARAM_STR, 250);

                $cmd->execute();

                $db = null;
                echo    '<div class="alert alert-success" role="alert">
                            User successfully created   
                        </div>';
            }
        }
        catch(Exception $error)
        {
            echo    '<div class="alert alert-danger" role="alert">'
                    . $error -> getMessage() .  
                    '</div>';
            
        }
    }
?>
</body>
</html>