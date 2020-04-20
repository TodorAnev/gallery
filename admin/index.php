<?php include_once("includes/header.php"); 
      if(!$session->is_signed_in()){redirect("login.php");} 
?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include_once("includes/nav_top.php"); ?>
            <?php include_once("includes/nav_side.php"); ?>
        </nav>

        <div id="page-wrapper">

           <?php include_once ("includes/admin_content.php"); ?>

        </div>
        <!-- /#page-wrapper -->

  <?php include_once("includes/footer.php"); ?>