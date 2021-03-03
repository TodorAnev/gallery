<?php include_once("includes/header.php");
if(!$session->is_signed_in()){redirect("login.php");} 

if(empty($_GET['id'])){
  redirect('photos.php');
} else{
  $photo = Photo::find_by_id($_GET['id']);

  if(isset($_POST['update'])){
    if($photo){
      $photo->p_title = $_POST['p_title'];
      $photo->p_description = $_POST['p_description'];
      $photo->p_caption = $_POST['p_caption'];
      $photo->p_alternate_text = $_POST['p_alternate_text'];

      $photo->save();
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
                    Edit photo
                    <small>Subheading</small>
                </h1>
                <?php  ?>
              <form action="" method="post">
                <div class="col-md-8">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name="p_title" class="form-control" value="<?php echo $photo->p_title ?>">
                    </div>
                    <div class="form-group">
                      <a class="thumbnail" href="#"><img src="<?php echo $photo->picture_path(); ?>" alt=""></a>
                    </div>
                    <div class="form-group">
                      <label for="caption">Caption</label>
                      <input type="text" name="p_caption" class="form-control" value="<?php echo $photo->p_caption ?>">
                    </div>
                    <div class="form-group">
                      <label for="alternate">Alternate Text</label>
                      <input type="text" name="p_alternate_text" class="form-control" value="<?php echo $photo->p_alternate_text ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" name="p_description" id="mytextarea" cols="30" rows="10"><?php echo $photo->p_description ?></textarea> 
                    </div>
                </div>
                <div class="col-md-4" >
                        <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                                <div class="box-inner">
                                      <p class="text ">
                                          Photo Id: <span class="data photo_id_box"><?php echo $photo->id ?></span>
                                      </p>
                                      <p class="text">
                                          Filename: <span class="data"><?php echo $photo->p_filename ?></span>
                                      </p>
                                      <p class="text">
                                        File Type: <span class="data"><?php echo $photo->p_type ?></span>
                                      </p>
                                      <p class="text">
                                         File Size: <span class="data"><?php echo $photo->p_size ?></span>
                                      </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                      <div class="info-box-delete pull-left">
                                          <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                      </div>
                                      <div class="info-box-update pull-right ">
                                          <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                      </div>   
                                </div>
                            </div>          
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