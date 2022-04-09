<?php
    $pageName = 'Saving registration...';
    require 'includes/header.php';

    try
    {

        $id = '';
        if(!empty(trim($_POST['id'])))
        {
            $id = $_POST['id'];
    
        } 
    
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
    
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
        if(empty(trim($confirmPassword)))
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Confirmation Password not given!!
                    </div>';
            $flag = false;
    
        }
        if($confirmPassword != $password)
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Passwords do not match!
                    </div>';
            $flag = false;
        }
    
        if($flag)
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
                if(!empty($id))
                {
                    $sql = "UPDATE users 
                            SET username = :username,
                                password = :password
                            WHERE userId = :id";
                }
                else
                {
                    $sql = "INSERT INTO users(username, password) 
                                    VALUES (:username, :password)";
                }
                
    
                $password = password_hash($password, PASSWORD_DEFAULT);
    
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':username', $username, PDO::PARAM_STR, 60);
                $cmd->bindParam(':password', $password, PDO::PARAM_STR, 250);
    
                if(!empty($id))
                {
                    $cmd->bindParam(':id', $id, PDO::PARAM_INT);
                }
    
                $cmd->execute();
    
                $db = null;
                echo    '<div class="alert alert-success" role="alert">
                            User list successfully updated   
                        </div>';
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