<?php
    $pageName = 'Login';
    require 'includes/header.php';
    if(isset($_GET['invalid']))
    {

      if($_GET['invalid'])
      {
        echo  '<div class="alert alert-danger" role="alert">
                Invalid login credentials!  
              </div>';
      }
    }
            
?>
<main>
<section class="vh-100 gradient-custom md-4">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <form method="post" action="check-login.php" class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login details!</p>

              <div class="form-outline form-white mb-4 ">
                <label class="form-label" for="username">  
                    <input type="email" id="username" name="username" class="form-control form-control-lg" placeholder="Email" required/>
                </label>
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="password">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required/>
                </label>
              </div>


              <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign In</button>

            </form >

            <div>
              <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a>
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
  require 'includes/footer.php';
?>