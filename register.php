<?php
    $pageName = 'Register';
    require 'includes/header.php';
?>

<section class="vh-100 gradient-custom md-4">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

          <!-- Add a confirm password entry also!!! -->

            <form method="post" action="save-register.php" class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
              <p class="text-white-50 mb-5">Please enter your email and password to register here!</p>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="username">  
                    <input type="email" id="username" name="username" class="form-control form-control-lg" placeholder="Email" />
                </label>
              </div>

              <!-- Confirm password required! -->
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="password">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password"/>
                </label>
              </div>


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
