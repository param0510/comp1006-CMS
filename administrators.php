<!-- This page displays the user list present in the database -->
<!-- It also gives users the ability to add/edit other users -->
<?php
// Authorizing the private page
    require 'includes/auth.php';
    $pageName = 'Administrators';
    require 'includes/header.php';
    try{

        // Connecting to the database
        require 'includes/db-conn.php';
        // Creating the sql query
        $sql = 'SELECT * FROM users';
        // preparing the sql query
        $cmd = $db->prepare($sql);
        // Execution of command
        $cmd->execute();
        // fetching all the data from the database
        $users=$cmd->fetchAll();
        // disconnecting from the database
        $db = null;
    }
    catch(Exception $error)
    {
        header("location:error.php");
    }
// Message display for the action produced - user list update in this case
    if(isset($_GET['update']))
    {

      if($_GET['update'])
      {
        echo  '<div class="alert alert-success" role="alert">
                User list successfully updated!  
              </div>';
      }
    }
?>
<!-- DOM displaying all the user data -->
    <main class="m-3">
        
        <h2>List of Administrators</h2>
        <table class="table table-striped mt-5 w-75 m-auto" >
            <!-- Table headings -->
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($users)
                    {
                        // Displaying each user data in seperate row
                        // Giving the function to update and delete the users in the table
                        $serialNo = 1;
                        foreach ($users as  $user) 
                        {
                            echo '<tr>
                                    <th scope="row">'.$serialNo.'</th>
                                    <td>'.$user['username'].'</td>
                                    <td><a class="btn btn-primary" href="register.php?id='.$user['userId'].'">Edit</a></td>
                                    <td><a class="btn btn-danger" onclick = "return confirmDelete()" href="delete-user.php?id='.$user['userId'].'" >Delete</a></td>
                                </tr>';
                            $serialNo = $serialNo +1;
                        }
                    }
                    // Add user feature
                    echo    '<tr>
                                <td><a class="btn btn-success" href="register.php">Add user</a></td>
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