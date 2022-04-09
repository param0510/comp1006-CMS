<?php
    require 'includes/auth.php';
    $pageName = 'Add/Edit Page';
    require 'includes/header.php';

    try
    {
        $id = '';
        if(!empty(trim($_POST['id'])))
        {
            $id = $_POST['id'];
    
        }
    
        $pageName = $_POST['pageName'];
        $heading = $_POST['heading'];
        $content = $_POST['content'];
    
        $flag = true;
        // I only validated the page name as it seems as the only basic minimum requirement to create a page
        if(empty(trim($pageName)) || strlen($pageName)>40)
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Page name cannot be empty or more than 40 characters in length!!!
                    </div>';
            $flag = false;
        }
        if(strlen($heading)>200)
        {
            echo    '<div class="alert alert-warning" role="alert">
                        Page heading cannot be more than 200 characters in length!!!
                    </div>';
            $flag = false;
        }
    
        if($flag)
        {
            require 'includes/db-conn.php';
            if(!empty($id))
            {
                $sql = "UPDATE pages 
                        SET pageName = :pageName,
                            heading = :heading,
                            content = :content
                        WHERE id = :id";
            }
            else
            {
                $sql = 'INSERT INTO pages(pageName, heading, content) 
                                VALUES(:pageName, :heading, :content)';
            }
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
            echo    '<div class="alert alert-success" role="alert">
                            Page successfully updated  
                        </div>';
        }
    }
    catch(Exception $e)
    {
        header("location:error.php");
    }

?>