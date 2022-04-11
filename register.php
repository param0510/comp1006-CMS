<!-- This is the register page which allows viewers to register -->
<?php
    // Setting the name of the page and including header file
    $pageName = 'Register';
    require 'includes/header.php';
    try
    {
      $id = '';
      // Checking whether id parameter is set or not for the user data to be edited
      if(isset($_GET['id']) && !empty($_GET['id']))
      {
        $id = $_GET['id'];
        // connecting to the database
        require 'includes/db-conn.php';
        // Retrieving data from the database, username in this case, when editing the user data
        $sql = 'SELECT * FROM users WHERE userId = :id';
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':id', $id, PDO::PARAM_INT);
        $cmd->execute();
        $user=$cmd->fetch();
        $db = null;

        // Checking whether user is present or not
        if($user)
        {
          // Storing the username in a variable
          $username = $user['username'];
        }
        else{
          // If the user is not present redirect to error page
          header("location:error.php");
        }

      }
    }
    catch(Exception $e)
    {
      // Exception handling for database errors
      header("location:error.php");
    }
?>

<!-- Bootstrap template incoming!!! -->
<main>
<section class="vh-100 gradient-custom md-4">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <!-- Form for user data entry -->
            <form method="post" action="save-register.php" class="mb-md-5 mt-md-4 pb-1">

              <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
              <p class="text-white-50 mb-5">Please enter an email and password to register here! <br><br> Passwords must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter!</p>

              <!-- Username -->
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="username">  
                    <input type="email" id="username" name="username" class="form-control form-control-lg" value="<?php if(!empty($id)){ echo $username; } ?>" placeholder="email@email.com" required />
                </label>
              </div>

              <!-- Password -->
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="password">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                </label>
              </div>

              <!-- Confirm Password -->
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="confirmPassword">
                <input type="password" id="confirmPassword" name="confirmPassword"  class="form-control form-control-lg" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                </label>
              </div>

              <!-- Hidden input for id of each user required for updating user info -->
              <input name="id" type="number" value="<?php if(!empty($id)){ echo $id; } ?>" hidden>
              
              <!-- Sign up button -->
              <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>

            </form >

            <div>
              <!-- Link for signing in if the user already has an account -->
              <p class="mb-0">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Sign In</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</main>

<?php
// footer file inclusion
  require 'includes/footer.php';
?>