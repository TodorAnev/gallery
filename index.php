    <?php include_once("includes/header.php"); 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1; //if it is not empty with set it to the get.
$items_per_page = 4;
$items_total_count = Photo::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM tbl_photos LIMIT $items_per_page OFFSET " . $paginate->offset();
// select something from table, but only give me $limit records starting from record $offset.
$photos = Photo::find_by_query($sql);

// $photos = Photo::find_all();
?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

        <div class="thumbnails row">

            <?php foreach ($photos as $photo): ?>
                    <div class="col-xs-6 col-md-3">
                        <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                            <img class="img-responsive" id="home_page_photo" src="admin/<?php echo $photo->picture_path();?>" alt="">
                        </a>
                    </div>
            <?php endforeach; ?>
        </div>
          
         <div class="row">
             <ul class="pager"> <!-- class="pagination" for a new pager-->
                <?php 

                if($paginate->page_total() > 1){
                    if($paginate->has_next()){
                        echo "<li class='next'><a href='index.php?page={$paginate->nextPage()}'>Next</a></li>";
                    }

                    for ($i=1 ; $i <= $paginate->page_total(); $i++) { 
                        if($i == $paginate->page){
                            echo "<li><a id='active' href='index.php?page=$i'>$i</a></li>"; //the current active page changes color
                        } else {
                            echo "<li><a href='index.php?page=$i'>$i</a></li>";
                        }
                    }

                    if($paginate->has_previous()){
                        echo "<li class='previous'><a href='index.php?page={$paginate->previousPage()}'>Previous</a></li>";
                    }
                }

                 ?>
             </ul>
         </div>

    </div>




            <!-- Blog Sidebar Widgets Column -->
           <!--  <div class="col-md-4"> -->

            
                 <?php //include_once("includes/sidebar.php"); ?>



        </div>
        <!-- /.row -->

        <?php include_once("includes/footer.php"); ?>
