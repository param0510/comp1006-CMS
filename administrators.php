
<?php
    require 'includes/auth.php';
    $pageName = 'Administrators';
    require 'includes/header.php';
    try{

        require 'includes/db-conn.php';
        $sql = 'SELECT * FROM users';
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $users=$cmd->fetchAll();
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
        
        <h2>List of Administrators</h2>
        <table class="table table-striped mt-5 w-75 m-auto" >
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
                        foreach ($users as  $user) 
                        {
                            echo '<tr>
                                    <th scope="row">'.$user['userId'].'</th>
                                    <td>'.$user['username'].'</td>
                                    <td><a class="btn btn-primary" href="register.php?id='.$user['userId'].'">Edit</a></td>
                                    <td><a class="btn btn-danger" onclick = "return confirmDelete()" href="delete-user.php?id='.$user['userId'].'" >Delete</a></td>
                                </tr>';
                        }
                    }
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
    
</body>
</html>