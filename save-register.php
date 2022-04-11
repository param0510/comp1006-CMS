<!-- This file saves the registration info to the database after necessary validation -->
<?php
    $pageName = 'Saving registration...';
    require 'includes/header.php';

    try
    {

        $id = '';
        // checking for any id values recieved through post method
        if(!empty(trim($_POST['id'])))
        {
            $id = $_POST['id'];
    
        } 
    
        // Storing all the form content retrieved through post method
        // username and passwords
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        // control variable for validation
        $flag = true;

        // Necessary validation for all the form inputs before updation in the database
        // validation of username to not be empty
        if(empty(trim($username)))
        {
        echo    '<div class="alert alert-warning" role="alert">
                    Username is empty!!
                </div>';
                $flag = false;
        }
        // checking for empty password/confirm password(s)
        if(empty(trim($password)))
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Password is empty!!
                    </div>';
            $flag = false;
        }
        if(empty(trim($confirmPassword)))
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Confirmation Password not given!!
                    </div>';
            $flag = false;
    
        }
        // checking for password match
        if($confirmPassword != $password)
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Passwords do not match!
                    </div>';
            $flag = false;
        }
    
        // If the user data is valid start the database updation
        if($flag)
        {
            // Check for the same username already present in the database
            // users are not allowed to have same usernames
            // validation for that is necessary as well!!
            // Creating empty user variable required for validation process
            $user = '';
            require 'includes/db-conn.php';
            if(empty($id))
            {
                // Validation in case of creating a new user
                $sql = 'SELECT * FROM users WHERE username = :username';
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
                $cmd->execute();
                $user = $cmd->fetch();
            }
            else
            {
                // Validation in case of updating a user already present
                $sql = 'SELECT * FROM users WHERE username = :username AND userId != :id';
                $cmd = $db ->prepare($sql);
                $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
                $cmd->bindParam(':id', $id, PDO::PARAM_INT);
                $cmd->execute();
                $user = $cmd->fetch();
            }
            
            // If username already exists, give warning message and stop the process
            if($user)
            {
                echo    '<div class="alert alert-warning" role="alert">
                            Username already exists!!
                        </div>';
                        $db = null;
            }
            else
            {
                // If username is not already present
                if(!empty($id))
                {
                    // Updating the user table if id is already present
                    $sql = "UPDATE users 
                            SET username = :username,
                                password = :password
                            WHERE userId = :id";
                }
                else
                {
                    // Creating a new user record if id is absent
                    $sql = "INSERT INTO users(username, password) 
                                    VALUES (:username, :password)";
                }
                
    
                // hashing the password before uploading to the database
                $password = password_hash($password, PASSWORD_DEFAULT);
    
                // prepare the commands and their execution
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
                $cmd->bindParam(':password', $password, PDO::PARAM_STR, 250);
    
                // In case id is present, we need to bind it as well
                if(!empty($id))
                {
                    $cmd->bindParam(':id', $id, PDO::PARAM_INT);
                }
    
                $cmd->execute();
    
                $db = null;

                if(!empty($id))
                {
                    // If the user is updated from admin panel, redirect to the user list page along with successful updation message
                    header("location:administrators.php?update=true");
                }
                else{
                    // If a new user entry is created, redirect to the login page along with successful updation message
                    header("location:login.php?create=true");
                }
            }
           
        }
    }
    catch(Exception $e){
        header("location:error.php");
    }
?>
<?php
    require 'includes/footer.php';
?>