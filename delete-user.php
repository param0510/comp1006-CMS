<!-- This is the delete user which deletes the user record from the database according to user id recieved using $_GET method -->

<?php
    // Authorization check for private page
    require 'includes/auth.php';
    // title
    $pageName = 'deleting user data...';
    // header
    require 'includes/header.php';

    try
    {
        $flag = true;
        
        $id = '';
        // checking whether the id parameter is set or not
        if(isset($_GET['id']) &&  !empty($_GET['id']))
        {
            $id = $_GET['id'];

            // connecting with the database
            require 'includes/db-conn.php';

            // Checking whether the user id exists or not 
            $sql = 'SELECT * FROM users WHERE userId = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $userPresent = $cmd->fetch();
            $db = null;

            if($userPresent)
            {
                // if user is present the record is deleted and the user list is updated
                require 'includes/db-conn.php';
                $sql = 'DELETE FROM users WHERE userId = :id';
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':id', $id, PDO::PARAM_INT);
                $cmd->execute();
                // Page redirection on successful record deletion
                echo    '<script>
                            window.location.replace("administrators.php?update=true");
                        </script>';
                $db = null;

            }
            else
            {
                // Page redirection for any errors
                echo    '<script>
                            window.location.replace("error.php");
                        </script>';
            }
        }
        else
        {
            // redirect to error page for no record found
            header("location:error.php");
        }
    }
    catch(Exception $error)
    {
        // redirection to error page for database errors
        header("location:error.php");
    }

    // footer file inclusion
    require 'includes/footer.php';
?>