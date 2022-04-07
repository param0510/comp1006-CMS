<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

    <script src="js/script.js" type="text/javascript" defer></script>
    <title><?php echo $pageName; ?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">logo here!</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>

            </button>

            <?php
            // please change this condition
            if(true)
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
                        <span class="nav-link">Username</span>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                        </li>
                        
                    </ul>
                </div>';
            }
            else
            {

                // make this dynamic
            echo '<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                        </li>
                        
                    </ul>
                
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