<!-- This is the user dashboard which contains links to all the user perks -->
<?php
// Including authorization and header files
    require 'includes/auth.php';
    // Setting up the title to be displayed
    $pageName = 'Dashboard';
    require 'includes/header.php';
?>
<!-- Displaying the dashboard contents and links to various user features -->
  <main>
    
    <h2 class="m-3">Welcome to the Dashboard</h2>
    <div class="list-group w-25 m-3 ">
      <a href="administrators.php" class="list-group-item list-group-item-action m-2 p-3 border border-success">Adminstrators</a>
      <a href="pages.php" class="list-group-item list-group-item-action m-2 p-3 border border-success">Pages</a>
      <a href="logo.php" class="list-group-item list-group-item-action m-2 p-3 border border-success">Change logo</a>
      <a href="index.php" class="list-group-item list-group-item-action m-2 p-3 border border-success">Public page</a>
    </div>
  </main>
<?php
  require 'includes/footer.php';
?>