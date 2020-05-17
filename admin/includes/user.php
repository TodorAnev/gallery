<?php 

class User extends Db_object
{

	protected static $db_table = "tbl_users";
	protected static $db_table_fields = array('u_username','u_password','f_name','l_name','u_image');
	public $id;
	public $u_username;
	public $u_password;
	public $f_name;
	public $l_name;
	public $u_image;
	public $upload_directory = "images";
	public $image_placeholder = "http://placehold.it/400x400&text=image";
	
	public function image_placeholder(){
		return empty($this->u_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->u_image;
	}

	public static function verify_user($u_username,$u_password){ // User Input
		global $database;
		$u_username = $database->escape_string($u_username); 
		$u_password = $database->escape_string($u_password);
		$query = "SELECT * FROM " .self::$db_table. " WHERE u_username = '$u_username' AND u_password = '$u_password' LIMIT 1";
		//$query = $database->p_statement("SELECT * FROM tbl_users WHERE u_username=? AND u_password=? LIMIT 1", "ss", [$u_username,$u_password]);
		$result = self::find_by_query($query);
		return !empty($result) ? array_shift($result) : false; //array_shift grabs the first item of the array and returns it
	}

	public function set_file($file){ // We pass it $_FILES['uploaded_file'] as an argument

		if(empty($file) || !$file || !is_array($file)){ // checking if the file is empty, if there is no file, and if it is not an array
			$this->errors[] = 'There was no file uploaded here'; // later we can echo this error to the user
			return false;
		} else if ($file['error'] != 0){ // 0 means there are no errors, but if it has an error we save it inside our errors array
			$this->errors[] = $this->UploadErrors[$file['error']];// we get our error from the UploadErrors
			return false;
		} else {
			$this->u_image = basename($file['name']); // $file['name'] === $_FILES['name'] and this gives us the exact filename
			$this->tmp_path   = $file['tmp_name'];
			$this->p_type     = $file['type'];
			$this->p_size     = $file['size'];
		}
	}

	public function image_upload(){ // the only time we return true is when we create the file
		// first we make sure that we don't have the photo, by checking the photo id
		if($this->id){
			$this->update();
		} else {
			if(!empty($this->errors)){
				return false;// if our errors array is not empty we return false 
			}
			if(empty($this->u_image) || empty($this->tmp_path)){
				$this->errors[] = 'The file is not available';
				return false;
			}
			// building target path
			$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->u_image; //filename = example.jpg
			// making sure we don't have the same file in our system
			if(file_exists($target_path)){
				$this->errors[] = "The file $this->u_image already exists";
				return false;
			}

			if(move_uploaded_file($this->tmp_path, $target_path)){
				if($this->create()){ // if it was able to create it
					unset($this->tmp_path); // we unset it, because the file has been moved to our desired directory
					return true;
				}
			} else {
				// if it doesn't work until here , we have problems with permissions
				$this->errors[] = "The folder probably doesn't have permissions";
				return false;
			}
		}
	}


} // End of Class User


 ?>