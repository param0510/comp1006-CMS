<?php
    require 'includes/auth.php';
    $pageName = 'deleting user data...';
    require 'includes/header.php';

    try
    {
        $flag = true;
        $id ='';
        $id = $_GET['id'];
        if(!empty($id))
        {
            require 'includes/db-conn.php';
            $sql = 'DELETE FROM users WHERE userId = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $db = null;
            echo    '<div class="alert alert-success" role="alert">
                            User record was deleted.   
                        </div>';
            //  use this to relocate to the adminstrators list 
            header("location:administrators.php");
    
        }
        else
        {
            // redirect to error page for no record found
            header("location:error.php");
        }
    }
    catch(Exception $error)
    {
        header("location:error.php");
    }


?>
<?php
  require 'includes/footer.php';
?>