<!-- This page allows users to update the logo of their website -->
<?php   
    // Including authorization and header files
    require 'includes/auth.php';
    $pageName = 'Logo';
    require 'includes/header.php';

    // Message display for the action produced - No image provided
    if(isset($_GET['noImage']))
    {

      if($_GET['noImage'])
      {
        echo  '<div class="alert alert-warning" role="alert">
                    Please attach the image first!  
              </div>';
      }
    }

    // Message display for the action produced - Wrong image extension
    if(isset($_GET['extension']))
    {

      if($_GET['extension'] == "false")
      {
        echo  '<div class="alert alert-warning" role="alert">
                    Only attach jpeg/png files please!  
              </div>';
      }
    }
?>
    <h2 class="m-3">Change your logo here</h2>

    <!-- form accepting jpeg/png files to upload -->
    <form action="save-logo.php" method="post" enctype="multipart/form-data">
        <div class="m-4 w-25 ">
            <label for="image" class="form-label">Attach files here....(jpeg/png only!!)</label>
            <input class="form-control" type="file" id="image" name="image" accept=".png,.jpg">
        </div>
        <fieldset class="form-group row m-4">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary ">Update</button>
            </div>
        </fieldset>
    </form>
<?php
    // Footer file inclusion
    require 'includes/footer.php';
?>