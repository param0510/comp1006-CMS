<!-- This the main home page of the public website -->
<!-- It displays a link to all the public web pages available through the database -->
<?php

    try
    {
        // Trying to get the id parameter if any webpage is requested from the database
        // This flag page is used to control the display the home page of the public site
        // If any page is requested, it displays the page contents otherwise it displays a list of webpages availabe with links to each one of them
        $flag = true;
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            // Storing the page id requested
            $id = $_GET['id'];
            require 'includes/db-conn.php';
            // Retrieving data of the requested page from the database
            $sql = 'SELECT * FROM pages WHERE id = :id';
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            $cmd->execute();
            $page = $cmd->fetch();

            // Storing the page element values

            // Generating auto-mated page names by values retrieved from the database
            $pageName = $page['pageName'];

            // Storing the heading and content of the page in respective variables
            $heading = $page['heading'];
            $content = $page['content'];
            // disconnecting from the database
            $db = null;

            $flag = true;
        }
        else
        {
            // Setting up the page title variable
            $pageName = "Page list";
            $flag=false;
        }

        $pageName = "Public Site | $pageName";
        require 'includes/header.php';
    
    }
    catch(Exception $e)
    {
        header("location:error.php");
    }

    
    if($flag)
    {
        // Displayin page contents according to the page id requested
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
        // Displaying the page list if no page id is requested
        require 'includes/db-conn.php';
        $sql = "SELECT * FROM pages";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $pages = $cmd->fetchAll();
        $db =null;

        echo    '<main class="m-4">
                    <h2>Public pages</h2>
                    <div class="list-group w-50 m-3 ">';
        
        foreach ($pages as $page) {
            $id = $page['id'];
            $name = $page['pageName'];
            
            echo        '<a href="index.php?id='.$id.'" class="list-group-item list-group-item-action m-2 p-3 border border-success">'.$name.'</a>';
        }
        echo        '</div>
                </main>';
    }

    // footer file inclusion
    require 'includes/footer.php';
?>