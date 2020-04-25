<?php 
// Uploading files from the user to a location

if(isset($_POST['submit'])){
echo "<pre>";
print_r($_FILES['file_upload']);
echo "<pre>";
// echo $the_error = $_FILES['file_upload']['error'] . "<br>";

$file_location = $_FILES['file_upload']['tmp_name'];
$file_name = $_FILES['file_upload']['name'];
$directory = "uploads";

echo (move_uploaded_file($file_location, $directory . "/" . $file_name)) ? "File uploaded seccessfully" : $the_error = $_FILES['file_upload']['error'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
	<form action="upload.php" enctype="multipart/form-data" method="post"> <!-- enctype - to send other type of files in post request --> 
		<input type="file" name="file_upload">
		<br>
		<input type="submit" name="submit">
	</form>

</body>
</html>