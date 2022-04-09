<?php

    try
    {
        $flag = true;
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id = $_GET['id'];
            require 'includes/db-conn.php';
            $sql = 'SELECT * FROM pages WHERE id = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $page = $cmd->fetch();
            $pageName = $page['pageName'];
            $heading = $page['heading'];
            $content = $page['content'];
            $db = null;

            $flag = true;
        }
        else
        {
    
            // require 'includes/db-conn.php';
            // $sql = 'SELECT * FROM pages ORDER BY id';
            // $cmd = $db->prepare($sql);
            // $cmd->execute();
            // $page = $cmd->fetch();
            // $id = $page['id'];
            // $db = null;
            $pageName = "Page list";
            $flag=false;
        }
        // $pageName = $page['pageName'];
        // $heading = $page['heading'];
        // $content = $page['content'];

        $pageName = "Public Site | $pageName";
        require 'includes/header.php';
    
    }
    catch(Exception $e)
    {
        header("location:error.php");
    }

    
    if($flag)
    {
        echo '<main class="m-4">
                <h2 class="mb-4">'.$heading.'</h2>
                <section class="w-75 m-auto">
                    <p>'
                        .$content.
                    '</p>
                </section>
            </main>';
    }
    else
    {
        require 'includes/db-conn.php';
        $sql = "SELECT * FROM pages";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $pages = $cmd->fetchAll();
        $db =null;

        echo    '<main class="m-4">
                    <h1>Public pages</h1>
                    <div class="list-group w-50 m-3 ">';
        
        foreach ($pages as $page) {
            $id = $page['id'];
            $name = $page['pageName'];
            
            echo '<a href="index.php?id='.$id.'" class="list-group-item list-group-item-action m-2 p-3 border border-success">'.$name.'</a>';
        }
        echo        '</div>
                </main>';
    }

    require 'includes/footer.php';
?>