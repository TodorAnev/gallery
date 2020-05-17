<?php include_once("includes/header.php");
if(!$session->is_signed_in()){redirect("login.php");} 


  $user = new User;

  if(isset($_POST['create'])){
    if($user){
      $user->u_username = $_POST['u_username'];
      $user->f_name = $_POST['f_name'];
      $user->l_name = $_POST['l_name'];
      $user->u_password = $_POST['u_password'];

      $user->set_file($_FILES['u_image']);

      $user->image_upload();
    }
  
}


?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include_once("includes/nav_top.php"); ?>
    <?php include_once("includes/nav_side.php"); ?>
</nav>

<div id="page-wrapper">

   <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add User
                    <small>Subheading</small>
                </h1>
                <?php  ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                      <input type="file" name="u_image">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="u_username" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="text" name="f_name" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="lastname">Last Name</label>
                      <input type="text" name="l_name" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="u_password" class="form-control">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary" name="create">Add User</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->


</div>
<!-- /#page-wrapper -->

<?php include_once("includes/footer.php"); ?>