<?php
    require 'includes/auth.php';
    $pageName = 'Pages';
    require 'includes/header.php';

    try{

        require 'includes/db-conn.php';
        $sql = 'SELECT * FROM pages';
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $pages=$cmd->fetchAll();
        $db = null;
    }
    catch(Exception $error)
    {
        echo    '<div class="alert alert-danger" role="alert">'
                    . $error -> getMessage() .  
                    '</div>';
    }
?>
    <main class="m-3">
        
        <h2>List of Pages</h2>
        <table class="table table-striped mt-5 w-75 m-auto" >
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Page Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($pages)
                    {
                        // Error with confirm Delete function in js
                        foreach ($pages as  $page) 
                        {
                            echo '<tr>
                                    <th scope="row">'.$page['id'].'</th>
                                    <td>'.$page['pageName'].'</td>
                                    <td><a class="btn btn-outline-primary" href="add_edit-page.php?id='.$page['id'].'">Edit</a></td>
                                    <td><a class="btn btn-outline-danger" onClick="return confirmDelete()" href="delete-page.php?id='.$page['id'].'">Delete</a></td>
                                </tr>';
                        }
                    }
                    echo    '<tr>
                                <td><a class="btn btn-success" href="add_edit-page.php">Add page</a></td>
                                <td></td>
                                <td></td>   
                                <td></td>
                            </tr>';
                   
                ?>
                
            </tbody>
        </table>
    </main>
</body>
</html>