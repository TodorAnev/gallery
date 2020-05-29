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
                    Comments
                </h1>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comment Body</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php 
                                $comments = Comment::find_all(); 
                                foreach ($comments as $comment) : ?>
                                      <tr>
                                      <td><?php echo $comment->id; ?></td>
                                      <td><?php echo $comment->c_author; ?>
                                           <div class="action_links">
                                              <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                          </div>
                                      </td>
                                      <td><?php echo $comment->c_body; ?></td>
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