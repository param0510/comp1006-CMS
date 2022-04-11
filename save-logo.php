<!-- This is the save logo page which saves the logo uploaded to the database after necessary validation -->
<?php
    require 'includes/header.php';
    try
    {
        // recieving the files from the form
        $image = $_FILES['image'];
        
        // Checking whether file has a name or not
        if(!empty($image['name']))
        {
            // Storing the file name
            $name = $image['name'];

            // Storing the temp location of the file
            $tmpName = $image['tmp_name'];

            // flag required for validation of image
            $flag = true;
            
            // Checking image extension... only jpeg/png files accepted
            if(((mime_content_type($tmpName))!= 'image/png') && ((mime_content_type($tmpName))!= "image/jpeg"))
            {
                echo '<div class="alert alert-warning" role="alert">
                    Please upload .png or .jpeg files only!!!
                    </div>';

                $flag = false;
            }
            // Starting the session, if not already started
            if(session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
            // making the name of the image unique
            $name = session_id().rand(0,255).'-'.$name;

            if($flag)
            {
                // moving the uploaded file from temporary location to the server folder
                move_uploaded_file($tmpName, "logo/$name");

                // Connecting to the database
                require 'includes/db-conn.php';

                // Construct created to just keep one record, for image name, in the database
                // Retrieving the database content
                $sql= 'SELECT * FROM logo';
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $logo = $cmd->fetch();
                $id = 1;
                // Checking whether database has an entry or not
                if(!empty($logo))
                {
                    // If an image name entry is present...... update it
                    $sql = 'UPDATE logo 
                            SET name = :name
                            WHERE id = :id';
                }
                else{
                    // If an image name entry is absent...... create one
                    $sql = 'INSERT INTO logo(id, name)
                                        VALUES(:id, :name)';
                }
                // preparing and execution of commands
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':id',$id, PDO::PARAM_INT);
                $cmd->bindParam(':name',$name, PDO::PARAM_STR, 250);
                $cmd->execute();
                
                // disconnecting from the database
                $db = null;
                // redirecting to the dashboard on succesfull upload
                header("location:dashboard.php");
            }

        }
        

    }
    catch(Exception $error)
    {
        // redirect to error page for any database connection errors
        header("location:error.php");
    }

    // footer file 
    require 'includes/footer.php';

?>