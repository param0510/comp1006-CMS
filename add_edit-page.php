<?php
    require 'includes/auth.php';
    $pageName = 'Add/Edit Page';
    require 'includes/header.php';
?>
    <h2 class="m-3">Add or Edit your pages here!</h2>

    <form class="m-3 mx-5" method="post" action="save-page.php">
        <fieldset class="form-group row my-4">
            <label for="pageName" class="col-sm-2 col-form-label">Page Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="pageName" name="pageName" placeholder="Name of your page...">
            </div>
        </fieldset>
        <fieldset class="form-group row my-4">
            <label for="heading" class="col-sm-2 col-form-label">Heading</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="heading" name="heading" placeholder="Heading of your page...">
            </div>
        </fieldset>
        <fieldset class="form-group row my-4">
            <label for="content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea rows="15" class="form-control" id="content" name="content" placeholder="Type in your content here..."></textarea>
            </div>
        </fieldset>
        
        <fieldset class="form-group row my-4">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
        </fieldset>
    </form>
</body>
</html>