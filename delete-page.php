<?php
    require 'includes/auth.php';
    $pageName = 'deleting page data...';
    require 'includes/header.php';

    try
    {

        $flag = true;
        // $id ='';
        $id = $_GET['id'];
        if(!empty($id))
        {
            require 'includes/db-conn.php';
            $sql = 'DELETE FROM pages WHERE id = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $db = null;
            echo    '<div class="alert alert-success" role="alert">
                        The page record was deleted.   
                    </div>';
            //  use this to relocate to the pages list 
                header("location:pages.php");
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
</body>
</html>