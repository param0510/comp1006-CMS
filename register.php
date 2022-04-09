<?php
    $pageName = 'Register';
    require 'includes/header.php';
    try
    {
      $id = '';
      if(isset($_GET['id']))
      {
          $id = $_GET['id'];
  
          require 'includes/db-conn.php';
          $sql = 'SELECT * FROM users WHERE userId = :id';
          $cmd = $db->prepare($sql);
          $cmd->bindParam(':id', $id, PDO::PARAM_INT);
          $cmd->execute();
          $user=$cmd->fetch();
  
          $username = $user['username'];
  
          $db = null;
      }
    }
    catch(Exception $e)
    {
      header("location:error.php");
    }
?>

<section class="vh-100 gradient-custom md-4">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

          <!-- Add a confirm password entry also!!! -->

            <form method="post" action="save-register.php" class="mb-md-5 mt-md-4 pb-1">

              <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
              <p class="text-white-50 mb-5">Please enter your email and password to register here!</p>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="username">  
                    <input type="email" id="username" name="username" class="form-control form-control-lg" value="<?php if(!empty($id)){ echo $username; } ?>" placeholder="Email" required />
                </label>
              </div>

              <!-- Confirm password required! -->
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="password">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required/>
                </label>
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="confirmPassword">
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg" placeholder="Confirm Password" required/>
                </label>
              </div>

              <input name="id" type="number" value="<?php if(!empty($id)){ echo $id; } ?>" hidden>
              
              <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>

            </form >

            <div>
              <p class="mb-0">Already have an account? <a href="login.php" class="text-white-50 fw-bold">Sign In</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    
</body>
</html>
