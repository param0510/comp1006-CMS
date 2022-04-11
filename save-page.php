<!-- This is the save page file, which saves the page content to the database -->
<?php
    // Authorization 
    require 'includes/auth.php';
    // Page title
    $pageName = 'Add/Edit Page';
    // header file
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
        // page name, heading and content of each page
        $pageName = $_POST['pageName'];
        $heading = $_POST['heading'];
        $content = $_POST['content'];
    
        // control variable for validation
        $flag = true;
        // Necessary validation for all the form inputs before updation in the database
        // validation of pageName to be under 40 and not empty
        if(empty(trim($pageName)) || strlen($pageName)>40)
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Page name cannot be empty or more than 40 characters in length!!!
                    </div>';
            $flag = false;
        }
        // validation of heading to be under 200
        if(strlen($heading)>200)
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Page heading cannot be more than 200 characters in length!!!
                    </div>';
            $flag = false;
        }

        // if all form inputs are valid database connection is made
        if($flag)
        {
            // connecting to the database
            require 'includes/db-conn.php';
            // Checking whether id value is present or not 
            if(!empty($id))
            {
                // If the id is present then just update the page content
                $sql = "UPDATE pages 
                        SET pageName = :pageName,
                            heading = :heading,
                            content = :content
                        WHERE id = :id";
            }
            else
            {
                // if the id is absent then create a new page
                $sql = 'INSERT INTO pages(pageName, heading, content) 
                                VALUES(:pageName, :heading, :content)';
            }
            // preparing and executing commands
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':pageName', $pageName, PDO::PARAM_STR, 40);
            $cmd->bindParam(':heading', $heading, PDO::PARAM_STR, 200);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR);
            if(!empty($id))
            {
                $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            }
            $cmd->execute();
            $db = null;
            // redirection to pages page with a successful message
            header("location:pages.php?success=true");
        }
    }
    catch(Exception $e)
    {
        // Error handling 
        header("location:error.php");
    }

    // footer file
    require 'includes/footer.php';

?>