 <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin page
                <small>Subheading</small>
            </h1>
            <?php 

            // $photos = Photo::find_all();
            // foreach ($photos as $photo) {
            //     echo $photo->p_title . "<br>";
            // }

            $photo1 = Photo::find_by_id(1);
            echo $photo1->p_title . "<br>";

            // $photo2 = Photo::find_by_query("SELECT p_title FROM tbl_photos WHERE id=1");
            // print_r($photo2);

            // $photo = new Photo();
            // $photo->id = 1;
            // $photo->p_title = 'My favourite photo';
            // $photo->p_type = 'png';
            // $photo->save();

            // echo INCLUDES_PATH;
            // echo SITE_ROOT;

             ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->