<?php 
// require_once("includes/init.php");
require_once("includes/header.php"); 
if($session->is_signed_in()){
	redirect("index.php");
}
if(isset($_POST['submit'])){
	$u_username = trim($_POST['u_username']);
	$u_password = trim($_POST['u_password']);
	// Method to check database user
	$u_found = User::verify_user($u_username,$u_password); // returns true or false
	if($u_found){
		$session->login($u_found);
		redirect("index.php"); 
	} else {
		$message = "Your password or username are incorrect";
	}
} else {
	$message = "";
	$u_username = "";
	$u_password = "";
}



 ?>


<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo $message; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="u_username" value="<?php echo htmlentities($u_username); ?>" >
	<!-- htmlentities is used to encode user input on a website so that users cannot insert harmful HTML codes into a site -->

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="u_password" value="<?php echo htmlentities($u_password); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>