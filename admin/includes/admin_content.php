 <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin page
                <small>Subheading</small>
            </h1>
            <?php 

            // testing
            // $result = User::find_all_users();
            // while($row = mysqli_fetch_array($result)){
            //     echo $row['u_username'] . "<br>";

            // }

            // $u_found = User::find_user_by_id(3);
            // $user = User::instantiate($u_found);

            // echo $user->l_name . "<br>";

            $users = User::find_all_users();

            foreach ($users as $user) {
                echo $user->f_name . "<br>";
            }

            $u_found = User::find_user_by_id(1);
            echo $u_found->u_username;

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