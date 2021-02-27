<?php include_once("includes/header.php");
include("includes/photo_library_modal.php");
if(!$session->is_signed_in()){redirect("login.php");} 

  if(empty($_GET['id'])){
    redirect("users.php");
  }

  $user = User::find_by_id($_GET['id']);

  if(isset($_POST['update'])){
    if($user){
      $user->u_username = $_POST['u_username'];
      $user->f_name = $_POST['f_name'];
      $user->l_name = $_POST['l_name'];
      //$user->u_password = $_POST['u_password'];
      if(empty($_FILES['u_image'])){
        $user->save();
      } else {
        $user->set_file($_FILES['u_image']);

        $user->image_upload(); // checks if user exists and if exists it is gonna update it and if it doesn't it creates it
        $user->save();
        redirect("edit_user.php?id=$user->id");
      }
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
                    Edit User
                    <small>Subheading</small>
                </h1>
                <div class="form-group col-md-offset-3">
                  <a href="#" data-toggle="modal" data-target="#photo-library"><img class="thumbnail img-responsive" src="<?php echo $user->image_placeholder(); ?>" alt=""></a>
                </div>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                      <input type="file" name="u_image">
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="u_username" class="form-control" value="<?php echo $user->u_username ?>">
                    </div>
                    <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="text" name="f_name" class="form-control" value="<?php echo $user->f_name ?>">
                    </div>
                    <div class="form-group">
                      <label for="lastname">Last Name</label>
                      <input type="text" name="l_name" class="form-control" value="<?php echo $user->l_name ?>">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="u_password" class="form-control">
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary" name="update">Update</button>
                      <a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>

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