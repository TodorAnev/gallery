<?php 
require_once("includes/header.php");

if(empty($_GET['id'])){
    redirect("index.php");
}
$photo = Photo::find_by_id($_GET['id']);
$session->post_views();

if(isset($_POST['submit'])){
    $c_author = trim($_POST['c_author']); //remove the spaces that come from the form
    $c_body = $_POST['c_body'];

    $new_comment = Comment::create_comment($photo->id,$c_author,$c_body);

    if($new_comment && $new_comment->save()){

        redirect("photo.php?id=$photo->id");
    } else {
        $message = "Not saved";
    }
} else {
    $c_author = "";
    $c_body = "";
}

$found_comments = Comment::find_comments($photo->id);
?>

<div class="row">
    <!-- Blog Post Content Column -->
    <div class="col-lg-12">

        <!-- Blog Post -->

        <!-- Title -->
        <h1><?php echo $photo->p_title; ?></h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#">Todor Anev</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive photo_size" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

        <!-- <hr> -->

        <!-- Post Content -->
        <p class="lead"><?php echo $photo->p_caption; ?></p>
        <p><?php echo $photo->p_description; ?></p>

        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form" method="post">
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="c_author" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="c_body" class="form-control" rows="3"></textarea>
                </div>
                <button name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <!-- Comment -->

        <?php foreach ($found_comments as $comment) :  ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment->c_author ?>
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                <?php echo $comment->c_body; ?>
            </div>
        </div>
    <?php endforeach; ?> 



</div>


</div>

<?php include_once("includes/footer.php"); ?>
