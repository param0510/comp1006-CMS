<?php
    $pageName = 'deleting page data...';
    require 'includes/header.php';

    $flag = true;
    // $id ='';
    $id = $_GET['id'];
    if(!empty($id))
    {
        try
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
            // header("location:pages.php");
        }
        catch(Exception $error)
        {
            echo    '<div class="alert alert-danger" role="alert">'
                    . $error -> getMessage() .  
                    '</div>';
        }

    }
    else
    {
        // redirect to error page for no record found
    }


?>
</body>
</html>