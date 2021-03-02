<?php include_once("includes/header.php"); 
      if(!$session->is_signed_in()){redirect("login.php");} 
$message = "";
if(isset($_POST['submit'])){
    $photo = new Photo;
    $photo->p_title = $_POST['title'];
    $photo->set_file($_FILES['file_upload']);
    if($photo->save()){ // if we are able to create it
        $message = "Photo uploaded sucessfully";
    } else {
        $message = join("<br>", $photo->errors);
    }
}


?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include_once("includes/nav_top.php"); 
          include_once("includes/nav_side.php"); ?>
</nav>

<div id="page-wrapper">

   <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Upload
                </h1>
                <div class="col-md-6">
                    <?php echo $message; ?>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="file" name="file_upload">
                    </div>
                    <button name="submit">Submit</button>
                </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->


</div>
<!-- /#page-wrapper -->

<?php include_once("includes/footer.php"); ?>