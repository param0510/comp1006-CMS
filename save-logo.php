<?php
    try
    {
        $image = $_FILES['image'];
        
        if(!empty($image['name']))
        {
            $name = $image['name'];

            $tmpName = $image['tmp_name'];

            $flag = true;
            
            if(((mime_content_type($tmpName))!= 'image/png') && ((mime_content_type($tmpName))!= "image/jpeg"))
            {
                echo '<div class="alert alert-warning" role="alert">
                    Please upload .png or .jpeg files only!!!
                    </div>';

                $flag = false;
            }
            if(session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
            // making the name unique
            $name = session_id().rand(0,255).'-'.$name;

            if($flag)
            {
                move_uploaded_file($tmpName, "logo/$name");

                require 'includes/db-conn.php';
                $sql= 'SELECT * FROM logo';
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $logo = $cmd->fetch();
                $id = 1;
                if(!empty($logo))
                {
                    $sql = 'UPDATE logo 
                            SET name = :name
                            WHERE id = :id';
                }
                else{
                    $sql = 'INSERT INTO logo(id, name)
                                        VALUES(:id, :name)';
                }
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':id',$id, PDO::PARAM_INT);
                $cmd->bindParam(':name',$name, PDO::PARAM_STR, 250);
                $cmd->execute();
                


                $db = null;
                header("location:dashboard.php");
            }

        }
        

    }
    catch(Exception $error)
    {
        echo    '<div class="alert alert-danger" role="alert">'
                    . $error -> getMessage() .  
                    '</div>';
        // redirect to error page
    }


?>