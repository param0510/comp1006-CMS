<!-- This is the delete page which deletes the page record from the database according to page id recieved using $_GET method -->
<?php
    // Authorization check for private page
    require 'includes/auth.php';
    // title
    $pageName = 'deleting page data...';
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
            $sql = 'SELECT * FROM pages WHERE id = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $pagePresent = $cmd->fetch();
            $db = null;

            if($pagePresent)
            {
                // if user is present the record is deleted and the user list is updated
                require 'includes/db-conn.php';
                $sql = 'DELETE FROM pages WHERE id = :id';
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':id', $id, PDO::PARAM_INT);
                $cmd->execute();
                echo    '<script>
                            window.location.replace("pages.php?success=true");
                        </script>';
                $db = null;
            }
            else
            {
                // The user id is not found so the page is redirected to error page
                // It kept giving me header already sent error
                // So I tried this and it works like a charm!!!
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
        // redirect to error page for database connection errors
        header("location:error.php");
    }

    // footer file inclusion
    require 'includes/footer.php';
?>