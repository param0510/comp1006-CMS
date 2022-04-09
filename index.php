<?php
    
    try
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            require 'includes/db-conn.php';
            $sql = 'SELECT * FROM pages WHERE id = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $page = $cmd->fetch();
            
            $db = null;
        }
        else
        {
            // redirect to error page 
            // exit(); Stop any other code from getting executed
    
            // or do this
            require 'includes/db-conn.php';
            $sql = 'SELECT * FROM pages ORDER BY id';
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $page = $cmd->fetch();
            $id = $page['id'];
            $db = null;
        }
            $pageName = $page['pageName'];
            $heading = $page['heading'];
            $content = $page['content'];
    }
    catch(Exception $e)
    {
        header("location:error.php");
    }

    $pageName = "Public Site | $pageName";
    require 'includes/header.php';
    
?>
    <main class="m-4">

        <h2 class="mb-4"><?php echo $heading;?></h2>
        <section class="w-75 m-auto">
            <p>
                <?php echo $content;?>
            </p>
        </section>
    </main>
</body>
</html>