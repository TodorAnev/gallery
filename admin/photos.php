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
              Photos
          </h1>
          <div class="col-md-12">
              <table class="table">
                  <thead>
                      <tr>
                          <th>Photo</th>
                          <th>Id</th>
                          <th>File Name</th>
                          <th>Title</th>
                          <th>Size</th>
                          <th>Photo Comments</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $photos = new Photo;
                    $photos = Photo::find_all(); 
                    foreach ($photos as $photo) : ?>
                      <tr>
                      <td><img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt="">
                      <div class="p_link">
                          <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                          <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                          <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                      </div>
                      </td>
                      <td><?php echo $photo->id; ?></td>
                      <td><?php echo $photo->p_filename; ?></td>
                      <td><?php echo $photo->p_title; ?></td>
                      <td><?php echo $photo->p_size; ?></td>
                      <td>
                        <a href="comment_photo.php?id=<?php echo $photo->id; ?>">
                          <?php $comments = Comment::find_comments($photo->id); echo count($comments); ?>  
                        </a>
                      </td>
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