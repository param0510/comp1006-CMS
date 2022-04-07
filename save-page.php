<?php
    require 'includes/auth.php';
    $pageName = 'Add/Edit Page';
    require 'includes/header.php';

    $pageName = $_POST['pageName'];
    $heading = $_POST['heading'];
    $content = $_POST['content'];

    $flag = true;
    if(empty(trim($pageName)))
    {
        echo    '<div class="alert alert-warning" role="alert">
                    Minimum requirement : Page name is empty!!!
                </div>';
        $flag = false;
    }

    if($flag)
    {
        try
        {

            require 'includes/db-conn.php';
            $sql = 'INSERT INTO pages(pageName, heading, content) 
                                VALUES(:pageName, :heading, :content)';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':pageName', $pageName, PDO::PARAM_STR, 40);
            $cmd->bindParam(':heading', $heading, PDO::PARAM_STR, 200);
            $cmd->bindParam(':content', $content, PDO::PARAM_STR);
            $cmd->execute();
            $db = null;
            echo    '<div class="alert alert-success" role="alert">
                            Page successfully updated  
                        </div>';
        }
        catch(Exception $error)
        {
            echo    '<div class="alert alert-danger" role="alert">'
                    . $error -> getMessage() .  
                    '</div>';
        }
    }

?>