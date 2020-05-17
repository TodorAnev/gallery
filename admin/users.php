<?php include_once("includes/header.php");
if(!$session->is_signed_in()){redirect("login.php");} ?>
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
                    Users
                    <small>Subheading</small>
                </h1>
                <a class="btn btn-primary" href="add_user.php">Add User</a>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                $users = User::find_all(); 
                                foreach ($users as $user) : ?>
                                      <tr>
                                      <td><?php echo $user->id; ?></td>
                                      <td><img class="admin-user-thumbnail user_image" src="<?php echo $user->image_placeholder(); ?>" alt="">
                                      </td>
                                      <td><?php echo $user->u_username; ?>
                                           <div class="action_links">
                                              <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                              <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                              <a href="#">View</a>
                                          </div>
                                      </td>
                                      <td><?php echo $user->f_name; ?></td>
                                      <td><?php echo $user->l_name; ?></td>
                                      </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table> 
                    <!-- End of table -->
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->


</div>
<!-- /#page-wrapper -->

<?php include_once("includes/footer.php"); ?>