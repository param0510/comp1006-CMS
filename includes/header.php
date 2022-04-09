<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" type="text/javascript" defer></script>
    <title><?php echo $pageName; ?></title>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        
            <a class="navbar-brand" href="index.php">
                <?php
                    try
                    {
                        include 'db-conn.php';
                        $sql = 'SELECT * FROM logo';
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $logo = $cmd->fetch();
                        $imageName = $logo['name'];
                        $db =null;
                        echo '<img src="logo/'.$imageName.'" alt="logo" class="" height="56">';
                    }
                    catch(Exception $e)
                    {
                        header("location:error.php");
                    }
                ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>

            </button>

            <?php
            // please change this condition
            if(session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
            if(!empty($_SESSION['username']))
            {
                // static navbar
            echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" href="administrators.php">Administrators</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="pages.php">Pages</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logo.php">Logo</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="index.php">Public Site</a>
                        </li>
                        
                    </ul>

                // add a user edit option for a click on username in the navbar

                </div>
                <div class="collapse navbar-collapse align-items-center" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">'.$_SESSION['username'].'</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        
                    </ul>
                </div>';
            }
            else
            {

                // make this dynamic
            echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

                    try
                    {
                        require 'includes/db-conn.php';
                        $sql = 'SELECT * FROM pages ORDER BY id';
                        $cmd= $db->prepare($sql);
                        $cmd -> execute();
                        $pages = $cmd->fetchAll();
                        $db = null;

                        foreach ($pages as $page) {
                            $id= $page['id'];
                            $name = $page['pageName'];
                            echo    '<li class="nav-item">
                                        <a class="nav-link" href="index.php?id='.$id.'">'.$name.'</a>
                                    </li>';
                        }

                    }
                    catch(Exception $error)
                    {
                        header("location:error.php");
                    }

                        
                        
            echo    '</ul>
                
                </div>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="register.php">Register</a>
                        </li>
                        
                    </ul>
                </div>';
            }
            ?>
        </div>
    </nav>