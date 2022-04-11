<!-- This page displays the page list present in the database -->
<!-- It also gives users the ability to add/edit other pages -->
<?php

    // Authorizing the private page
    require 'includes/auth.php';
    $pageName = 'Pages';
    require 'includes/header.php';
    // Trying to connect to the database to retrieve the list of pages available
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
        header("location:error.php");
    }

    // Message display for the action produced - page list update in this case
    if(isset($_GET['success']))
    {

      if($_GET['success'])
      {
        echo  '<div class="alert alert-success" role="alert">
                Page list successfully updated!  
              </div>';
      }
    }
?>
<!-- DOM displaying all the list of pages present in the database -->

    <main class="m-3">
        
        <h2>List of Pages</h2>
        <table class="table table-striped mt-5 w-75 m-auto" >
            <thead>
                <!-- Table headings -->
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
                        // Displaying each user data in seperate row
                        // Giving the function to update and delete the users in the table
                        $serialNo = 1;
                        foreach ($pages as  $page) 
                        {
                            echo '<tr>
                                    <th scope="row">'.$serialNo.'</th>
                                    <td>'.$page['pageName'].'</td>
                                    <td><a class="btn btn-outline-primary" href="add_edit-page.php?id='.$page['id'].'">Edit</a></td>
                                    <td><a class="btn btn-outline-danger" onClick="return confirmDelete()" href="delete-page.php?id='.$page['id'].'">Delete</a></td>
                                </tr>';
                            $serialNo = $serialNo +1;
                        }
                    }
                    // Add user feature
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
<?php
  require 'includes/footer.php';
?>