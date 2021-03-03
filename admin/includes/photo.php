<?php 

class Photo extends Db_object
{
	
	protected static $db_table = "tbl_photos";
	protected static $db_table_fields = array('id','p_title','p_description','p_filename','p_type','p_size','p_alternate_text','p_caption');
	public $id;
	public $p_title;
	public $p_description;
	public $p_filename;
	public $p_type;
	public $p_size;
	public $p_alternate_text;
	public $p_caption;

	public $tmp_path; //temporary path for the images, move the pictures to a more permanent place
	public $upload_directory = "images"; // permanent directory
	public $errors       	 = array(); // we put the errors in here and we display the errors the the user
	public $UploadErrors 	 = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
	);

	public function set_file($file){ // We pass it $_FILES['uploaded_file'] as an argument


		$file_type = $file['type'];
		$allowed = array("image/jpeg", "image/png", "iamge/jpg");

		if(empty($file) || !$file || !is_array($file)){ // checking if the file is empty, if there is no file, and if it is not an array
			$this->errors[] = 'There was no file uploaded here'; // later we can echo this error to the user
			return false;
		} else if ($file['error'] != 0){ // 0 means there are no errors, but if it has an error we save it inside our errors array
			$this->errors[] = $this->UploadErrors[$file['error']];// we get our error from the UploadErrors
			return false;
		} else if(!in_array($file_type, $allowed)){
			$this->errors[] = 'Allowed extensions are jpg, jpeg and png';
		} else {
			$this->p_filename = basename($file['name']); // $file['name'] === $_FILES['name'] and this gives us the exact filename
			$this->tmp_path   = $file['tmp_name'];
			$this->p_type     = $file['type'];
			$this->p_size     = $file['size'];
		}
	}

	public function picture_path(){ // so we don't have a static directory and even we don't have image folder the file will save
		return $this->upload_directory . DS . $this->p_filename;
	}

	public function save(){ // the only time we return true is when we create the file
		// first we make sure that we don't have the photo, by checking the photo id
		if($this->id){
			$this->update();
		} else {
			if(!empty($this->errors)){
				return false;// if our errors array is not empty we return false 
			}
			if(empty($this->p_filename) || empty($this->tmp_path)){
				$this->errors[] = 'The file is not available';
				return false;
			}
			// building target path
			$target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->p_filename; //filename = example.jpg
			// making sure we don't have the same file in our system
			if(file_exists($target_path)){
				$this->errors[] = "The file $this->p_filename already exists";
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

	public function delete_photo(){ 
		if($this->delete()){
			$target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
	}
}